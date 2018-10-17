<?php

namespace App;

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
}
