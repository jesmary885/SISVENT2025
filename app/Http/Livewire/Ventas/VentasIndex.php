<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Livewire\Component;

class VentasIndex extends Component
{

    protected $listeners = ['render'];

    public function cant_productos($registro){

        return ProductoVenta::where('venta_id',$registro->id)
        ->sum('cantidad');
    }

    public function subtotal_dol($registro){

       return ProductoVenta::where('venta_id',$registro->id)->sum('precio_dolares');
    }

     public function subtotal_bol($registro){

       return ProductoVenta::where('venta_id',$registro->id)->sum('precio_bolivares');
    }



    public function render()
    {
         $registros = Venta::latest('id')
                ->paginate(20);

        return view('livewire.ventas.ventas-index', compact('registros'));
    }


}
