<?php

namespace App\Http\Livewire\Ventas;

use App\Models\ProductoVenta;
use Livewire\Component;

class VentaView extends Component
{
    protected $listeners = ['render'];
    public $open = false, $venta, $productos;
    
    // Agregar propiedades para totales
    public $subtotal_dol = 0;
    public $subtotal_bol = 0;

    public function close()
    {
        $this->open = false;
    }

    public function mount($venta)
    {
        $this->venta = $venta;
        $this->productos = ProductoVenta::where('venta_id', $venta->id)->get();
        $this->calcularTotales();
    }

    /**
     * Calcular subtotales correctamente
     */
    public function calcularTotales()
    {
        $this->subtotal_dol = 0;
        $this->subtotal_bol = 0;

        foreach ($this->productos as $producto) {
            $this->subtotal_dol += (floatval($producto->precio_dolares) * floatval($producto->cantidad));
            $this->subtotal_bol += (floatval($producto->precio_bolivares) * floatval($producto->cantidad));
        }
    }

    public function render()
    {
        return view('livewire.ventas.venta-view');
    }
}