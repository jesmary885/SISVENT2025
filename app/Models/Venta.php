<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at','updated_at'];

    //Relaion uno a muhos inversa

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

     //Relacion uno a muchos
   
    public function producto_ventas(){
        return $this->hasMany(ProductoVenta::class);
    }

    public function pagoVentas(){
        return $this->hasMany(PagoVenta::class);
    }


}
