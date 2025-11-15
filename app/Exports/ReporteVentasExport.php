<?php

namespace App\Exports;

use App\Models\Venta;
use App\Models\ProductoVenta;
use App\Models\Compra;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReporteVentasExport implements FromView
{
    protected $fechaInicio;
    protected $fechaFin;
    protected $datos;

    public function __construct($fechaInicio, $fechaFin, $datos)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->datos = $datos;
    }

    public function view(): View
    {
        return view('exports.reporte-ventas', [
            'fechaInicio' => $this->fechaInicio,
            'fechaFin' => $this->fechaFin,
            'datos' => $this->datos
        ]);
    }
}