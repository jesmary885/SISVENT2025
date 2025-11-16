<?php

namespace App\Http\Livewire\PuntoVenta;

use App\Models\CarroCompra;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\ProductoVenta;
use App\Models\Tasa;
use App\Models\Venta;
use Livewire\Component;

class PuntoVentaFinalizar extends Component
{

    public $metodo_pago,$registro,$open = false,$total_dol, $total_bs,$user_id;

    public $monto_cancelado = 1,$montocdol,$montocbs,$cambio,$deuda;

     
    protected $rules_dol = [
      'montocdol' => 'required|numeric',
    ];

    protected $rules_bs = [
      'montocbs' => 'required|numeric',
    ];

    protected $rules = [
       'metodo_pago' => 'required',
    ];

    public function mount()
    {
        $this->user_id = auth()->user()->id;

        $registros = CarroCompra::where('user_id', $this->user_id)
            ->where('estado', 'abierta')
            ->get();

        $total = 0;

        foreach ($registros as $registro) {
            $precio = floatval($registro->producto->precio_venta);
            $total = $total + ($precio * $registro->cantidad);
        }

        // Guardar como float para cálculos
        $this->total_dol = floatval($total);
        $total_bss = $this->total_dol * floatval(Tasa::find(1)->tasa_actual);
        $this->total_bs = floatval(number_format($total_bss, 2, '.', ''));
        
        // Inicializar valores
        $this->cambio = 0;
    }

    public function close(){

        $this->open = false;

        $this->reset('montocdol','montocbs');
    }

    public function updatedMetodoPago($value)
    {
        // Resetear valores cuando cambia el método de pago
        $this->reset(['montocdol', 'montocbs', 'cambio', 'deuda', 'monto_cancelado']);
        
        if ($value === 'dol_efec') {
            $this->deuda = $this->total_dol;
        } elseif ($value === 'bs_efec') {
            $this->deuda = $this->total_bs;
        }
    }


    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    public function updatedMontocdol($value)
    {
        // Convertir a float y limpiar el valor
        $monto = floatval($value) ?? 0;
        
        // Asegurarse de que total_dol sea float
        $total = floatval($this->total_dol);
        
        // Calcular cambio y deuda
        if ($monto >= $total) {
            $this->cambio = $monto - $total;
            $this->deuda = 0;
        } else {
            $this->cambio = 0;
            $this->deuda = $total - $monto;
        }
        
        // Formatear para mostrar (opcional)
        $this->cambio = number_format($this->cambio, 2, '.', '');
        $this->deuda = number_format($this->deuda, 2, '.', '');
    }

    public function updatedMontocbs($value)
    {
        // Convertir a float y limpiar el valor
        $monto = floatval($value) ?? 0;
        
        // Asegurarse de que total_bs sea float
        $total = floatval($this->total_bs);
        
        // Calcular cambio y deuda
        if ($monto >= $total) {
            $this->cambio = $monto - $total;
            $this->deuda = 0;
        } else {
            $this->cambio = 0;
            $this->deuda = $total - $monto;
        }
        
        // Formatear para mostrar (opcional)
        $this->cambio = number_format($this->cambio, 2, '.', '');
        $this->deuda = number_format($this->deuda, 2, '.', '');
    }

    public function render()
    {
        return view('livewire.punto-venta.punto-venta-finalizar');
    }

    public function save(){

        
        $rules = $this->rules;
        $this->validate($rules);

        if($this->monto_cancelado == 0){
            if($this->metodo_pago == 'bs_efec'){
                $rules_bs = $this->rules_bs;
                $this->validate($rules_bs);
            }
            if($this->metodo_pago == 'dol_efec'){
                $rules_dol = $this->rules_dol;
                $this->validate($rules_dol);
            }
        }

        

        $venta = new Venta();
        $venta->user_id = $this->user_id;
        $venta->subtotal_dolares = $this->total_dol;
        $venta->subtotal_bolivares = $this->total_bs;
        $venta->total_dolares = $this->total_dol;
        $venta->total_bolivares = $this->total_bs;
        $venta->cliente_id = Cliente::find(1)->id;
        $venta->metodo_pago= $this->metodo_pago;
        $venta->save();

        $registros = CarroCompra::where('user_id',$this->user_id)
        ->where('estado','abierta')
        ->get();


        foreach($registros as $registro){

            $total_bss = $registro->producto->precio_venta * Tasa::find(1)->tasa_actual;
            $precio_total_bs = number_format($total_bss,2, '.', '');

            $producto_venta = new ProductoVenta();
            $producto_venta ->venta_id = $venta->id;
            $producto_venta ->producto_id = $registro->producto->id;
            $producto_venta ->precio_dolares = $registro->producto->precio_venta;
            $producto_venta ->precio_bolivares = $precio_total_bs;
            $producto_venta ->cantidad = $registro->cantidad;
            $producto_venta ->save();

            $producto=Producto::where('id',$registro->producto->id)->first();

            $cantidad_new = $producto->cantidad - $registro->cantidad;

            $producto->update([
                'cantidad' => $cantidad_new
            ]);

            $registro->update([
                'estado' => 'cerrada'
            ]);
       
        }

        $this->reset(['open']);
        $this->emitTo('punto-venta.punto-venta-create','mount');
        
        notyf()
          ->duration(9000) // 2 seconds
          ->position('y', 'top')
          ->position('x', 'right')
          ->addSuccess('Venta finalizada con éxito');

    }
}
