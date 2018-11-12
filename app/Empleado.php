<?php

namespace App;

use App\Turno;

use DB;

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
    	return $this->belongsToMany(Turno::class, 'empleados_turnos');
    }
    public function empleados_turnos($id){
        $empleados_turnos = DB::table('empleados_turnos')->where('empleado_id', '=', $id)->get();
        return $empleados_turnos;

    }
}
