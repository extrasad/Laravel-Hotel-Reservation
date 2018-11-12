<?php

namespace App;

use App\Consumo;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion', 'costo'
    ];
    public function consumo(){
    	return $this->belongsToMany(Consumo::class);
    }
}
