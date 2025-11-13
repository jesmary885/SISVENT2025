<?php

namespace App\Http\Livewire;

use App\Models\Tasa;
use App\Models\Venta;
use Livewire\Component;

class Home extends Component
{

    public $ganancia_mes_bs, $ganancia_mes_dol, $ganancia_dia_dol, $ganancia_dia_bs, $ventas_dia, $tasa_dia;


    public function render()
    {

        
        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

        $this->ganancia_dia_bs = Venta::whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->sum('total_bolivares');

        $this->ganancia_dia_dol = Venta::whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->sum('total_dolares');

         $this->ganancia_mes_bs = Venta::whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->sum('total_bolivares');

        $this->ganancia_mes_dol = Venta::whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->sum('total_dolares');

        $this->ventas_dia = Venta::whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->count();


        $this->tasa_dia = Tasa::find(1)->tasa_actual;

        return view('livewire.home');
    }
}
