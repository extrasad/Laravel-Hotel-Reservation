<?php

namespace App;

use App\Diex;

use Illuminate\Database\Eloquent\Model;

class Diex extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ci', 'nombre', 'placa', 'observacion'
    ];
}
