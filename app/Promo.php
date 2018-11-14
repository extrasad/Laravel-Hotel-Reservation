<?php

namespace App;

use App\Promo;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
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