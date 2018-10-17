<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emmpleado extends Model
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
}
