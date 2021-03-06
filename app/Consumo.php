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
        'costo', 'estado'
    ];
    public function producto(){
    	return $this->belongsToMany(Producto::class, 'consumo_producto');
    }
    public function reservacion()
    {
        return $this->belongsTo(Reservacion::class);
    }
}
