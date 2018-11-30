<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo'
    ];
}