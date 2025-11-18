<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use App\Models\Producto;
use App\Models\Tasa;
use App\Models\Venta;
use Livewire\Component;

class PuntoVentaCreate extends Component
{
    protected $listeners = [
        'render' => 'render',
        'carritoActualizado' => 'calcularTotales',
        'ventaFinalizada' => 'limpiarCarrito' // Agregar este listener
    ];
    
    public $open = false, $venta_nro, $cant_producto;
    public $search, $user_id, $monto_recibido;
    public $cliente_general = '1', $cantidad, $presentacion, $marca_id, $categoria, $precio_venta, $precio_compra, $stock_minimo, $vencimiento, $fecha_vencimiento;
    
    // Propiedades para almacenar los totales calculados
    public $total_global = 0;
    public $total_bs = 0;

    protected $rules = [
        'nombre' => 'required|max:255|min:2',
        'marca_id' => 'required',
        'presentacion' => 'required',
        'precio_venta' => 'required',
        'vencimiento' => 'required',
        'stock_minimo' => 'required',
    ];

    public function mount()
    {
        $this->user_id = auth()->user()->id;

        $ultimoRegistro = Venta::latest()->first();
        if($ultimoRegistro) $this->venta_nro = $ultimoRegistro->id + 1;
        else $this->venta_nro = 1;

        $this->calcularTotales();
    }

    // Agregar este método
    public function limpiarCarrito()
    {
        // Forzar recarga del componente
        $this->mount();
        $this->render();
        
        // También puedes limpiar manualmente si es necesario
        $this->cant_producto = 0;
        $this->total_global = 0;
        $this->total_bs = 0;
        
        \Log::info('Carrito limpiado después de venta finalizada');
    }

    public function updatedSearch($value)
    {
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
        
        // IMPORTANTE: Forzar re-render cuando cambie el search
        $this->render();
    }

    public function render()
    {
        // MANTENER tu lógica original del search
        if($this->search) {
            $registros = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->orWhere('cod_barra', 'LIKE', '%' . $this->search . '%')
                ->where('estado', 'Activo')
                ->latest('id')
                ->get();
        } else {
            $registros = [];
        }

        $registros_carro = CarroCompra::where('estado', 'abierta')
            ->where('user_id', $this->user_id)
            ->get();

        if(!$registros_carro || $registros_carro->isEmpty()) {
            $registros_carro = [];
            $this->cant_producto = 0;
        } else {
            $this->cant_producto = CarroCompra::where('estado', 'abierta')
                ->where('user_id', $this->user_id)
                ->sum('cantidad');
        }

        // Recalcular totales
        $this->calcularTotales();

        return view('livewire.punto-venta.punto-venta-create', compact('registros', 'registros_carro'));
    }

    /**
     * Método principal para calcular todos los totales
     */
    public function calcularTotales()
    {
        $registros = CarroCompra::where('user_id', $this->user_id)
            ->where('estado', 'abierta')
            ->get();

        $total_global = 0;

        foreach($registros as $registro) {
            $precio = floatval($registro->producto->precio_venta);
            $cantidad = floatval($registro->cantidad);
            $total_global += ($precio * $cantidad);
        }

        $tasa_actual = floatval(Tasa::find(1)->tasa_actual);
        $total_bs = $total_global * $tasa_actual;

        $this->total_global = $total_global;
        $this->total_bs = $total_bs;

        return [
            'total_global' => $this->total_global,
            'total_bs' => $this->total_bs
        ];
    }

    /**
     * Métodos para cálculos individuales
     */
    public function subtotal_dol($product, $cant)
    {
        $producto = Producto::find($product);
        if (!$producto) return 0;
        
        $precio_dolares = floatval($producto->precio_venta) * floatval($cant);
        return $precio_dolares;
    }

    public function subtotal_bol($product, $cant)
    {
        $producto = Producto::find($product);
        if (!$producto) return 0;
        
        $precio_dolares = floatval($producto->precio_venta) * floatval($cant);
        $precio_bs = $precio_dolares * floatval(Tasa::find(1)->tasa_actual);
        return $precio_bs;
    }

    public function precio_bolivares($product)
    {
        $precio_bs = floatval($product) * floatval(Tasa::find(1)->tasa_actual);
        return $precio_bs;
    }

    /**
     * Métodos para la vista (usan las propiedades ya calculadas)
     */
    public function total_pagar_global()
    {
        return $this->total_global;
    }

    public function total_pagar_bs()
    {
        return $this->total_bs;
    }

    /**
     * Método para que otros componentes obtengan los totales
     */
    public function obtenerTotales()
    {
        return $this->calcularTotales();
    }

    public function delete($product)
    {
        $prod_destroy = CarroCompra::where('id', $product)->first();
        if($prod_destroy) {
            $prod_destroy->delete();
            
            $this->calcularTotales();
            $this->emitTo('punto-venta.punto-venta-create', 'render');
            $this->emit('carritoActualizado');
        }
    }
}