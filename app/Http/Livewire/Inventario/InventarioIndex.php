<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\ProductoLote;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Livewire\Component;

class InventarioIndex extends Component
{

    public $search,$product_delete;

    protected $listeners = ['render','confirmacion' => 'confirmacion'];

    public function render()
    {

        $registros = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
                ->where('estado','Habilitado')
                ->latest('id')
                ->paginate(20);



        return view('livewire.inventario.inventario-index',compact('registros'));
    }

     public function delete($productoId){
        $this->product_delete = $productoId;
        $busqueda = ProductoVenta::where('producto_id',$productoId)->first();


        if($busqueda) $this->emit('errorSize', 'Este producto esta asociado a una venta, no puede eliminarlo');
        else $this->emit('confirm', 'Esta seguro de eliminar este producto?','inventario.inventario-index','confirmacion','El producto se ha eliminado.');
    }

    public function confirmacion(){
        $prod_destroy = Producto::where('id',$this->product_delete)->first();
        $prod_destroy->delete();

        $product_delete_lotes = ProductoLote::where('producto_id',$this->product_delete)->get();

        foreach($product_delete_lotes as $pl){
            $pl->delete();
        }


        $product_delete_compras = Compra::where('producto_id',$this->product_delete)->get();

        foreach($product_delete_compras as $pc){
            $pc->delete();
        }

    }
}
