<?php

namespace App\Http\Livewire\Administracion\Compras;

use App\Models\Proveedor;
use Livewire\Component;

class ComprasEdit extends Component
{

    protected $listeners = ['render'];
    public $open = false,$registro,$user_id,$proveedores,$proveedor_id,$cantidad,$precio_compra_dolares,$precio_compra_bolivares, $tasa_compra,$fecha_vencimiento,$lote_numero,$metodo_pago,$total_dolares;

    protected $rules = [
      'nombre' => 'required|max:255|min:2',
    ];


    public function close(){

        $this->open = false;

      

    }

    public function render()
    {
        return view('livewire.administracion.compras.compras-edit');
    }

     public function mount(){


          $this->cantidad = $this->registro->cantidad;


         $this->proveedores = Proveedor::all();
          $this->proveedor_id = $this->registro->proveedor_id;
      

        
    }


    public function save(){

      $rules = $this->rules;
      $this->validate($rules);




        $this->registro->update([
            'nombre' => $this->nombre,
        ]);

          $this->reset(['open']);
          $this->emitTo('administracion.compras.compras-index','render');
  

        notyf()
          ->duration(9000) // 2 seconds
          ->position('y', 'top')
          ->position('x', 'right')
          ->addSuccess('compra modificada exitosamente');


    }
}
