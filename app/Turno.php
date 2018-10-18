<?php

namespace App;

use App\Empleado;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    //
    protected $fillable = [
        'fecha', 'hora_entrada', 'hora_salida'
    ];
    public function empleado(){
    	return $this->belongsToMany(Empleado::class);
    }
}
