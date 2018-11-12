<?php

namespace App;

use App\Reservacion;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado', 'costo', 'habitacion'
    ];
    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }
}
