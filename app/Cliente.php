<?php

namespace App;

use App\Reservacion;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci', 'nombre', 'fecha', 'observacion', 'estado'
    ];
    public function reservaciones()
    {
        return $this->hasMany(Reservacion::class);
    }
}
