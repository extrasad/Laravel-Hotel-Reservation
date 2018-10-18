<?php

namespace App;

use App\Producto;

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
        'costo', 'hora', 'fecha', 'estado'
    ];
    public function producto(){
    	return $this->belongsToMany(Producto::class);
    }
}
