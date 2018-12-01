<?php

use Illuminate\Database\Seeder;
use App\Tarifario;

class TarifarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarifario = new Tarifario();
        $tarifario->tipo = 'Sencilla';
        $tarifario->save();

        $tarifario2 = new Tarifario();
        $tarifario2->tipo = 'Matrimonial';
        $tarifario2->save();
    }
}