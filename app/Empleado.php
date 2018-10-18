<?php

namespace App;

use App\Turno;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci', 'nombre'
    ];
    public function turnos(){
    	return $this->belongsToMany(Turno::class);
    }
}
