<?php

namespace App;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    //
    protected $fillable = [
        'costo', 'hora_entrada', 'hora_salida', 'fecha_entrada', 'fecha_salida', 'observacion', 'estado'
    ];
    public function habitacion(){
    	return $this->belongsTo(Habitacion::class);
    }
    public function auto(){
    	return $this->belongsTo(Auto::class);
    }
    public function clientes(){
    	return $this->belongsTo(Cliente::class);
    }
}
