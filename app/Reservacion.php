<?php

namespace App;

use App\Habitacion;

use App\Auto;

use App\Cliente;

use App\Consumo;

use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    //
    protected $fillable = [
        'costo', 'hora_entrada', 'fecha_entrada', 'fecha_salida', 'observacion', 'estado', 'costo_hab'
    ];
    public function habitacion(){
    	return $this->belongsTo(Habitacion::class);
    }
    public function auto(){
    	return $this->belongsTo(Auto::class);
    }
    public function cliente1(){
    	return $this->belongsTo(Cliente::class);
    }
    public function cliente2(){
    	return $this->belongsTo(Cliente::class);
    }
    public function consumo()
    {
        return $this->hasOne(Consumo::class);
    }
}
