<?php

namespace App\Http\Livewire\Ventas;

use App\Models\ProductoVenta;
use Livewire\Component;

class VentaView extends Component
{

    protected $listeners = ['render'];
    public $open = false,$venta,$productos;

     public function close(){

        $this->open = false;

    }

    public function mount($venta){

        $this->venta = $venta;

        $this->productos = ProductoVenta::where('venta_id',$venta->id)->get();

    }




    public function render()
    {
        return view('livewire.ventas.venta-view');
    }
}
