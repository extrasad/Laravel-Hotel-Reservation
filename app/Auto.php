<?php

namespace App;

use App\Reservacion;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'placa', 'modelo', 'color', 'observacion', 'estado', 'fecha'
    ];
    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }
}
