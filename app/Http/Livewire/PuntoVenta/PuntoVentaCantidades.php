<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use Livewire\Component;

class PuntoVentaCantidades extends Component
{

    protected $listeners = ['render' => 'render'];

    public $quantity,$registro, $usuario,$user_id;
    public $qty = 1;


    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function mount(){

        $this->user_id = auth()->user()->id;

        $this->quantity = qty_available($this->registro);
    }


    public function addItem(){

        $busqueda = CarroCompra::where('producto_id',$this->registro->id)
            ->where('user_id',$this->user_id)
            ->where('estado','abierta')
            ->first();

        if($busqueda) {
            $cant = $busqueda->cantidad + $this->qty;

            $busqueda->update([
                'cantidad' => $cant
            ]);
        }
        else
            {

                $producto_venta = new CarroCompra();
                $producto_venta->producto_id = $this->registro->id;
                $producto_venta->cantidad = $this->qty;
                $producto_venta->user_id = $this->user_id;
                $producto_venta->estado = 'abierta';
                $producto_venta->save();


            } 

           


        $this->reset('qty');

        $this->emit('carritoActualizado'); // Agrega esta línea

        $this->emitTo('punto-venta.punto-venta-create','render');
    
    }

  


    public function render()
    {
        return view('livewire.punto-venta.punto-venta-cantidades');
    }
}
