<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Compra;
use App\Models\ProductoVenta;
use Livewire\Component;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportesVentas extends Component
{

    public $ventasMensuales = [];
    public $ventasAnuales = [];
    public $mesActual;
    public $añoActual;
    
    // Filtros por fecha
    public $fechaInicio;
    public $fechaFin;
    
    // Propiedades para estadísticas
    public $totalMensualDolares = 0;
    public $totalAnualDolares = 0;
    public $totalVentasPeriodo = 0;
    public $ingresosTotales = 0;
    public $costoVentas = 0;
    public $gananciaBruta = 0;
    public $gastosCompras = 0;
    public $gananciaNeta = 0;
    public $promedioVenta = 0;
    public $productoMasVendido = null;
    public $ventasPorMetodoPago = [];
     

    public function mount()
    {
        $this->mesActual = Carbon::now()->month;
        $this->añoActual = Carbon::now()->year;
        
        $this->fechaInicio = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->fechaFin = Carbon::now()->endOfMonth()->format('Y-m-d');
        
        $this->cargarDatosGraficas();
        $this->cargarEstadisticas();
    }

     public function exportarPDF()
    {
        try {
            // Preparar datos para el PDF
            $datosExportacion = [
                'ingresosTotales' => $this->ingresosTotales,
                'costoVentas' => $this->costoVentas,
                'gananciaBruta' => $this->gananciaBruta,
                'gastosCompras' => $this->gastosCompras,
                'gananciaNeta' => $this->gananciaNeta,
                'totalVentasPeriodo' => $this->totalVentasPeriodo,
                'promedioVenta' => $this->promedioVenta,
                'productoMasVendido' => $this->productoMasVendido,
                'ventasPorMetodoPago' => $this->ventasPorMetodoPago,
                'ventasMensuales' => $this->ventasMensuales,
                'ventasAnuales' => $this->ventasAnuales,
            ];

            $pdf = PDF::loadView('exports.reporte-ventas', [
                'fechaInicio' => $this->fechaInicio,
                'fechaFin' => $this->fechaFin,
                'datos' => $datosExportacion
            ])->setPaper('a4', 'portrait');

            // Generar nombre del archivo
            $nombreArchivo = 'reporte-ventas-' . $this->fechaInicio . '-a-' . $this->fechaFin . '.pdf';

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, $nombreArchivo);

        } catch (\Exception $e) {
            \Log::error('Error generando PDF: ' . $e->getMessage());
            session()->flash('error', 'Error al generar el reporte PDF: ' . $e->getMessage());
        }
    }

    public function cargarDatosGraficas()
    {
        try {
            // Gráfica mensual - ventas por día del mes actual
            $ventasMensualesData = Venta::select(
                    DB::raw('DAY(created_at) as dia'),
                    DB::raw('COALESCE(SUM(total_dolares), 0) as total_dolares'),
                    DB::raw('COALESCE(SUM(total_bolivares), 0) as total_bolivares'),
                    DB::raw('COUNT(*) as total_ventas')
                )
                ->whereMonth('created_at', $this->mesActual)
                ->whereYear('created_at', $this->añoActual)
                ->groupBy(DB::raw('DAY(created_at)'))
                ->orderBy('dia')
                ->get();

            $this->ventasMensuales = $ventasMensualesData->toArray();
            $this->totalMensualDolares = $ventasMensualesData->sum('total_dolares');

            // Gráfica anual - ventas por mes del año actual
            $ventasAnualesData = Venta::select(
                    DB::raw('MONTH(created_at) as mes'),
                    DB::raw('COALESCE(SUM(total_dolares), 0) as total_dolares'),
                    DB::raw('COALESCE(SUM(total_bolivares), 0) as total_bolivares'),
                    DB::raw('COUNT(*) as total_ventas')
                )
                ->whereYear('created_at', $this->añoActual)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('mes')
                ->get();

            $this->ventasAnuales = $ventasAnualesData->toArray();
            $this->totalAnualDolares = $ventasAnualesData->sum('total_dolares');

             

            // Debug data
            $this->debugData = [
                'mes_actual' => $this->mesActual,
                'año_actual' => $this->añoActual,
                'total_mensual' => $this->totalMensualDolares,
                'total_anual' => $this->totalAnualDolares,
                'ventas_mensuales_count' => count($this->ventasMensuales),
                'ventas_anuales_count' => count($this->ventasAnuales),
            ];


        } catch (\Exception $e) {
            $this->ventasMensuales = [];
            $this->ventasAnuales = [];
            $this->totalMensualDolares = 0;
            $this->totalAnualDolares = 0;
        }
    }

    public function cargarEstadisticas()
    {
        try {
            // 1. INGRESOS TOTALES (Ventas del período)
            $estadisticasVentas = Venta::whereBetween('created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])->select(
                DB::raw('COUNT(*) as total_ventas'),
                DB::raw('COALESCE(SUM(total_dolares), 0) as total_ventas_dolares'),
                DB::raw('COALESCE(AVG(total_dolares), 0) as promedio_venta')
            )->first();

            $this->totalVentasPeriodo = $estadisticasVentas->total_ventas;
            $this->ingresosTotales = $estadisticasVentas->total_ventas_dolares;
            $this->promedioVenta = $estadisticasVentas->promedio_venta;

            // 2. COSTO REAL - MÉTODO PRÁCTICO CON PROMEDIO DE COMPRAS
            $this->costoVentas = $this->calcularCostoVentasReal();

            // 3. GASTOS EN NUEVAS COMPRAS (Inversión en inventario del período)
            $this->gastosCompras = Compra::whereBetween('created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])->sum('total_pagado_dolares');

            // 4. CÁLCULO DE GANANCIAS
            $this->gananciaBruta = $this->ingresosTotales - $this->costoVentas;
            $this->gananciaNeta = $this->gananciaBruta - $this->gastosCompras;

            // 5. PRODUCTO MÁS VENDIDO
            $this->productoMasVendido = ProductoVenta::whereBetween('producto_ventas.created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])->join('productos', 'producto_ventas.producto_id', '=', 'productos.id')
            ->select(
                'productos.nombre',
                DB::raw('SUM(producto_ventas.cantidad) as total_vendido'),
                DB::raw('SUM(producto_ventas.cantidad * producto_ventas.precio_dolares) as total_ingresos')
            )
            ->groupBy('productos.id', 'productos.nombre')
            ->orderByDesc('total_vendido')
            ->first();

            // 6. VENTAS POR MÉTODO DE PAGO
            $this->ventasPorMetodoPago = Venta::whereBetween('created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])->select(
                'metodo_pago',
                DB::raw('COUNT(*) as cantidad'),
                DB::raw('COALESCE(SUM(total_dolares), 0) as total_dolares')
            )
            ->groupBy('metodo_pago')
            ->get();

        } catch (\Exception $e) {
            \Log::error('Error cargando estadísticas: ' . $e->getMessage());
            $this->resetEstadisticas();
        }
    }

    private function calcularCostoVentasReal()
    {
        try {
            // Obtener todos los productos vendidos en el período con sus cantidades
            $productosVendidos = ProductoVenta::whereBetween('producto_ventas.created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])
            ->join('productos', 'producto_ventas.producto_id', '=', 'productos.id')
            ->select(
                'producto_ventas.producto_id',
                'productos.nombre',
                DB::raw('SUM(CAST(producto_ventas.cantidad as DECIMAL(10,2))) as cantidad_vendida')
            )
            ->groupBy('producto_ventas.producto_id', 'productos.nombre')
            ->get();

            $costoTotal = 0;

            foreach ($productosVendidos as $productoVendido) {
                // Obtener el precio de compra promedio de este producto
                $precioCompraPromedio = Compra::where('producto_id', $productoVendido->producto_id)
                    ->where('created_at', '<=', Carbon::parse($this->fechaFin)->endOfDay())
                    ->avg('precio_compra_dolares');

                // Si no hay compras registradas, usar un porcentaje estimado (60% del precio de venta)
                if (!$precioCompraPromedio) {
                    // Obtener el precio de venta promedio del producto
                    $precioVentaPromedio = ProductoVenta::where('producto_id', $productoVendido->producto_id)
                        ->whereBetween('created_at', [
                            Carbon::parse($this->fechaInicio)->startOfDay(),
                            Carbon::parse($this->fechaFin)->endOfDay()
                        ])
                        ->avg('precio_dolares');
                    
                    // Estimar costo como 60% del precio de venta (puedes ajustar este porcentaje)
                    $precioCompraPromedio = $precioVentaPromedio * 0.6;
                }

                $costoTotal += $productoVendido->cantidad_vendida * $precioCompraPromedio;
            }

            return $costoTotal;

        } catch (\Exception $e) {
            \Log::error('Error calculando costo ventas: ' . $e->getMessage());
            
            // Fallback: usar porcentaje fijo si hay error
            return $this->ingresosTotales * 0.6;
        }
    }

    // Método alternativo más simple (por si el anterior falla)
    private function calcularCostoVentasSimple()
    {
        try {
            return ProductoVenta::whereBetween('producto_ventas.created_at', [
                Carbon::parse($this->fechaInicio)->startOfDay(),
                Carbon::parse($this->fechaFin)->endOfDay()
            ])
            ->join('compras', 'producto_ventas.producto_id', '=', 'compras.producto_id')
            ->select(DB::raw('
                SUM(
                    CAST(producto_ventas.cantidad as DECIMAL(10,2)) * 
                    compras.precio_compra_dolares
                ) as costo_total
            '))
            ->value('costo_total') ?? ($this->ingresosTotales * 0.6);

        } catch (\Exception $e) {
            return $this->ingresosTotales * 0.6;
        }
    }

    private function resetEstadisticas()
    {
        $this->totalVentasPeriodo = 0;
        $this->ingresosTotales = 0;
        $this->costoVentas = 0;
        $this->gananciaBruta = 0;
        $this->gastosCompras = 0;
        $this->gananciaNeta = 0;
        $this->promedioVenta = 0;
        $this->productoMasVendido = null;
        $this->ventasPorMetodoPago = [];
    }

    public function updatedFechaInicio()
    {
        $this->cargarEstadisticas();
    }

    public function updatedFechaFin()
    {
        $this->cargarEstadisticas();
    }

    
    public function render()
    {
        return view('livewire.reportes.reportes-ventas');
    }
}
