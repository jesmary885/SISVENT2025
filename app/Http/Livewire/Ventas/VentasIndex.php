<?php

namespace App\Http\Livewire\Ventas;

use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Venta;
use Livewire\Component;
use Livewire\WithPagination;

class VentasIndex extends Component
{
    use WithPagination;
    
    public $perPage = 10;

 

    protected $listeners = [
    'render', 
    'ventaCreada' => 'actualizarLista' // Agregar este listener
    ];

// Agregar este método
public function actualizarLista()
{
    // Forzar recarga de la lista de ventas
    $this->resetPage(); // Reiniciar a la primera página
    $this->render();
    
    \Log::info('Lista de ventas actualizada después de nueva venta');
}

    public function cant_productos($registro)
    {
        return ProductoVenta::where('venta_id', $registro->id)
            ->sum('cantidad');
    }

    public function subtotal_dol($registro)
    {
        // CORREGIDO: Sumar el total de productos (precio * cantidad)
        return ProductoVenta::where('venta_id', $registro->id)
            ->get()
            ->sum(function($producto) {
                return floatval($producto->precio_dolares) * floatval($producto->cantidad);
            });
    }

    public function subtotal_bol($registro)
    {
        // CORREGIDO: Sumar el total de productos (precio * cantidad)
        return ProductoVenta::where('venta_id', $registro->id)
            ->get()
            ->sum(function($producto) {
                return floatval($producto->precio_bolivares) * floatval($producto->cantidad);
            });
    }

    // Método alternativo más eficiente (RECOMENDADO)
    public function total_dolares($registro)
    {
        // Usar los totales ya guardados en la venta
        return floatval($registro->total_dolares);
    }

    public function total_bolivares($registro)
    {
        // Usar los totales ya guardados en la venta
        return floatval($registro->total_bolivares);
    }

    public function render()
    {
        $registros = Venta::latest('id')
            ->paginate($this->perPage);

        return view('livewire.ventas.ventas-index', compact('registros'));
    }
}