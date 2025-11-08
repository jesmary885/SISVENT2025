<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use App\Models\Tasa;
use Livewire\Component;

class PuntoVentaFinalizar extends Component
{

    public $metodo_pago,$registro,$open = false,$total_dol, $total_bs,$user_id;

    public $monto_cancelado = 1,$montocdol,$montocbs,$cambio,$deuda;
      public function close(){
        $this->open = false;
    }

    public function mount(){

        $this->user_id = auth()->user()->id;

      $registros = CarroCompra::where('user_id',$this->user_id)
        ->where('estado','abierta')
        ->get();

        
      $total = 0;

      foreach($registros as $registro){

        $precio = $registro->producto->precio_venta;

        $total = $total + ( $precio * $registro->cantidad);

      }

      $this->total_dol = $total;
      $this->total_bs = $this->total_dol * Tasa::find(1)->tasa_actual;
    }

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function updatedMontocdol($value){
        if ($value) {

            if($this->montocdol > $this->total_dol) $this->cambio = $this->montocdol - $this->total_dol;
            else $this->cambio = 0;

            if($this->montocdol < $this->total_dol) $this->deuda =  $this->total_dol - $this->montocdol;
            else $this->deuda = 0;
            
        }
    }

     public function updatedMontocbs($value){
        if ($value) {

            if($this->montocbs > $this->total_bs) $this->cambio = $this->montocbs - $this->total_bs;
            else $this->cambio = 0;

            if($this->montocbs < $this->total_bs) $this->deuda =  $this->total_bs - $this->montocbs;
            else $this->deuda = 0;
            
        }
    }

    public function render()
    {
        return view('livewire.punto-venta.punto-venta-finalizar');
    }

    public function save(){



    }
}
