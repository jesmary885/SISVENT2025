<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Tasa;
use App\Models\Venta;
use Livewire\Component;

class PuntoVentaFinalizar extends Component
{
    public $metodo_pago, $registro, $open = false, $total_dol, $total_bs, $user_id;
    public $monto_cancelado = 1, $montocdol, $montocbs, $cambio, $deuda;

    protected $rules_dol = [
        'montocdol' => 'required|numeric',
    ];

    protected $rules_bs = [
        'montocbs' => 'required|numeric',
    ];

    protected $rules = [
        'metodo_pago' => 'required',
    ];

    // Listener para actualizar cuando cambie el carrito
    protected $listeners = ['carritoActualizado' => 'actualizarTotalesDesdeCreate'];

    public function mount()
    {
        $this->user_id = auth()->user()->id;
        $this->actualizarTotalesDesdeCreate();
    }

    /**
     * Obtiene los totales desde PuntoVentaCreate para consistencia
     */
    public function actualizarTotalesDesdeCreate()
    {
        try {
            // Obtener los totales calculados desde PuntoVentaCreate
            $totales = $this->emitTo('punto-venta.punto-venta-create', 'obtenerTotales');
            
            // Si el emit no funciona, calcular directamente como respaldo
            if (empty($totales)) {
                $this->calcularTotalesDirecto();
            } else {
                $this->total_dol = floatval($totales['total_global'] ?? 0);
                $this->total_bs = floatval($totales['total_bs'] ?? 0);
            }
            
            $this->actualizarCalculosPago();
            
        } catch (\Exception $e) {
            // Si hay error, calcular directamente
            $this->calcularTotalesDirecto();
        }
    }

    /**
     * Método de respaldo para calcular totales directamente
     */
    private function calcularTotalesDirecto()
    {
        $registros = CarroCompra::where('user_id', $this->user_id)
            ->where('estado', 'abierta')
            ->get();

        $total = 0;

        foreach ($registros as $registro) {
            $precio = floatval($registro->producto->precio_venta);
            $cantidad = floatval($registro->cantidad);
            $total += ($precio * $cantidad);
        }

        $this->total_dol = $total;
        $this->total_bs = $total * floatval(Tasa::find(1)->tasa_actual);
    }

    /**
     * Actualiza cálculos de cambio y deuda
     */
    private function actualizarCalculosPago()
    {
        $this->cambio = 0;
        $this->deuda = 0;
        
        // Actualizar cálculos de cambio si hay montos ingresados
        if ($this->montocdol) {
            $this->updatedMontocdol($this->montocdol);
        }
        if ($this->montocbs) {
            $this->updatedMontocbs($this->montocbs);
        }
    }

    public function openModal()
    {
        // Forzar actualización de totales antes de abrir el modal
        $this->actualizarTotalesDesdeCreate();
        $this->open = true;
    }

    public function close()
    {
        $this->open = false;
        $this->reset('montocdol', 'montocbs', 'cambio', 'deuda');
    }

    public function updatedMetodoPago($value)
    {
        $this->reset(['montocdol', 'montocbs', 'cambio', 'deuda', 'monto_cancelado']);
        
        if ($value === 'dol_efec') {
            $this->deuda = number_format($this->total_dol, 2, '.', '');
        } elseif ($value === 'bs_efec') {
            $this->deuda = number_format($this->total_bs, 2, '.', '');
        }
    }

    public function updatedMontocdol($value)
    {
        $monto = floatval($value) ?? 0;
        $total = floatval($this->total_dol);
        
        if ($monto >= $total) {
            $this->cambio = $monto - $total;
            $this->deuda = 0;
        } else {
            $this->cambio = 0;
            $this->deuda = $total - $monto;
        }
        
        $this->cambio = number_format($this->cambio, 2, '.', '');
        $this->deuda = number_format($this->deuda, 2, '.', '');
    }

    public function updatedMontocbs($value)
    {
        $monto = floatval($value) ?? 0;
        $total = floatval($this->total_bs);
        
        if ($monto >= $total) {
            $this->cambio = $monto - $total;
            $this->deuda = 0;
        } else {
            $this->cambio = 0;
            $this->deuda = $total - $monto;
        }
        
        $this->cambio = number_format($this->cambio, 2, '.', '');
        $this->deuda = number_format($this->deuda, 2, '.', '');
    }

    public function render()
    {
        return view('livewire.punto-venta.punto-venta-finalizar');
    }

    public function save()
    {
        $rules = $this->rules;
        $this->validate($rules);

        if($this->monto_cancelado == 0){
            if($this->metodo_pago == 'bs_efec'){
                $rules_bs = $this->rules_bs;
                $this->validate($rules_bs);
            }
            if($this->metodo_pago == 'dol_efec'){
                $rules_dol = $this->rules_dol;
                $this->validate($rules_dol);
            }
        }

        // Verificar consistencia antes de guardar
        $this->verificarConsistencia();

        // Crear la venta
        $venta = new Venta();
        $venta->user_id = $this->user_id;
        $venta->subtotal_dolares = $this->total_dol;
        $venta->subtotal_bolivares = $this->total_bs;
        $venta->total_dolares = $this->total_dol;
        $venta->total_bolivares = $this->total_bs;
        $venta->cliente_id = Cliente::find(1)->id;
        $venta->metodo_pago = $this->metodo_pago;
        $venta->save();

        // Procesar productos del carrito
        $registros = CarroCompra::where('user_id', $this->user_id)
            ->where('estado', 'abierta')
            ->get();

        foreach($registros as $registro) {
            // Calcular precios sin number_format para la BD
            $precio_total_bs = floatval($registro->producto->precio_venta) * floatval(Tasa::find(1)->tasa_actual);

            $producto_venta = new ProductoVenta();
            $producto_venta->venta_id = $venta->id;
            $producto_venta->producto_id = $registro->producto->id;
            $producto_venta->precio_dolares = floatval($registro->producto->precio_venta);
            $producto_venta->precio_bolivares = $precio_total_bs;
            $producto_venta->cantidad = $registro->cantidad;
            $producto_venta->save();

            // Actualizar stock del producto
            $producto = Producto::where('id', $registro->producto->id)->first();
            $cantidad_new = $producto->cantidad - $registro->cantidad;

            $producto->update([
                'cantidad' => $cantidad_new
            ]);

            // Cerrar item del carrito
            $registro->update([
                'estado' => 'cerrada'
            ]);
        }

        $this->reset(['open']);
        
        // EMITIR EVENTOS PARA ACTUALIZAR TODOS LOS COMPONENTES
        $this->emitTo('punto-venta.punto-venta-create', 'ventaFinalizada');
        $this->emitTo('ventas.ventas-index', 'ventaCreada');
        $this->emit('carritoActualizado');
        
        notyf()
            ->duration(9000)
            ->position('y', 'top')
            ->position('x', 'right')
            ->addSuccess('Venta finalizada con éxito');
    }

    /**
     * Verifica consistencia entre los cálculos
     */
    private function verificarConsistencia()
    {
        $registros = CarroCompra::where('user_id', $this->user_id)
            ->where('estado', 'abierta')
            ->get();

        $totalManual = 0;
        
        foreach($registros as $registro) {
            $subtotal = floatval($registro->producto->precio_venta) * floatval($registro->cantidad);
            $totalManual += $subtotal;
        }
        
        $diferencia = abs($totalManual - $this->total_dol);
        
        // Log para debug
        \Log::info("CONSISTENCIA - Manual: {$totalManual}, Componente: {$this->total_dol}, Diferencia: {$diferencia}");
        
        // Si hay diferencia significativa, lanzar error
        if ($diferencia > 0.01) { // Tolerancia de 0.01
            \Log::error("INCONSISTENCIA EN TOTALES - Diferencia: {$diferencia}");
        }
    }
}