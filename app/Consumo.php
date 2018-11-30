<?php

namespace App;

use App\Producto;

use App\Reservacion;

use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'costo_total', 'estado', 'cantidad', 'costo_producto', 'producto_id', 'nombre_producto'
    ];
    public function producto(){
    	return $this->hasOne(Producto::class);
    }
    public function reservacion()
    {
        return $this->belongsTo(Reservacion::class);
    }
}
