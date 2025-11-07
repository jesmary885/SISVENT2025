<?php

namespace App\Http\Livewire\PuntoVenta;

use Livewire\Component;

class PuntoVentaFinalizar extends Component
{

    public $metodo_pago,$registro,$open = false;

    public $monto_cancelado = 1,$monto_cancelado_total_dol,$monto_cancelado_total_bs;
      public function close(){

        

        $this->open = false;


    }

    public function render()
    {
        return view('livewire.punto-venta.punto-venta-finalizar');
    }
}
