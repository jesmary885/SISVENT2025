<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use App\Models\Producto;
use App\Models\Tasa;
use App\Models\Venta;
use Livewire\Component;

class PuntoVentaCreate extends Component
{

    protected $listeners = ['render' => 'render','mount' => 'mount' ];
    public $open = false,$venta_nro,$cant_producto;
    public $search,$user_id,$monto_recibido ;
    public $cliente_general = '1',$cantidad,$presentacion,$marca_id,$categoria,$precio_venta,$precio_compra,$stock_minimo,$vencimiento,$fecha_vencimiento;

    
    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }
    
    
    protected $rules = [
      'nombre' => 'required|max:255|min:2',
      'marca_id' => 'required',
      'presentacion' => 'required',
      'precio_venta' => 'required',
      'vencimiento' => 'required',
      'stock_minimo' => 'required',

    ];

    public function mount(){
        $this->user_id = auth()->user()->id;

        $ultimoRegistro = Venta::latest()->first();

        if($ultimoRegistro) $this->venta_nro = $ultimoRegistro->id + 1;
        else $this->venta_nro = 1;

    }

    
    public function render()
    {

      if($this->search){

        $registros = Producto::where('nombre', 'LIKE', '%' . $this->search . '%')
          ->orwhere('cod_barra', 'LIKE', '%' . $this->search . '%')
          ->where('estado','Habilitado')
          ->latest('id')
          ->get();

      }
      else{
         $registros = [];
      }

      $registros_carro  = CarroCompra::where('estado','abierta')
        ->where('user_id',$this->user_id)
        ->get();


      if(!$registros_carro ){

        $registros_carro = [];
        $this->cant_producto = 0;

      } 
      else{

        $this->cant_producto = CarroCompra::where('estado','abierta')
          ->where('user_id',$this->user_id)
          ->sum('cantidad');
      }
      
         

        return view('livewire.punto-venta.punto-venta-create',compact('registros','registros_carro'));
    }

    public function subtotal_dol($product,$cant){

      $precio_dolares = (Producto::find($product)->precio_venta) * $cant;

      return $precio_dolares;
    }

     public function subtotal_bol($product,$cant){

      $precio_dolares = (Producto::find($product)->precio_venta) * $cant;

      $precio_bs = $precio_dolares * Tasa::find(1)->tasa_actual;

      return $precio_bs;
    }

    public function precio_bolivares($product){
     
      $precio_bs = $product * Tasa::find(1)->tasa_actual;

      return $precio_bs;
    }

    public function total_pagar_global(){
      $registros = CarroCompra::where('user_id',$this->user_id)
        ->where('estado','abierta')
        ->get();

      $total = 0;

      foreach($registros as $registro){

        $precio = $registro->producto->precio_venta;

        $total = $total + ( $precio * $registro->cantidad);

      }

      return $total;

    }

    public function total_pagar_bs(){

      
     
      $precio_bs = $this->total_pagar_global() * Tasa::find(1)->tasa_actual;

      return $precio_bs;
    }

 





      public function delete($product){

        $prod_destroy = CarroCompra::where('id',$product)->first();
        $prod_destroy->delete();

        $this->emitTo('punto-venta.punto-venta-create','render');


    }
}
