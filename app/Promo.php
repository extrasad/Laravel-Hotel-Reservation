<?php

namespace App;

use App\Promo;

use Illuminate\Database\Eloquent\Model;

class Diex extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo', 'descripcion', 'cantidad', 'costo'
    ];
}