<?php

use Illuminate\Database\Seeder;
use App\Promo;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promo = new Promo();
        $promo->tipo = 'Sencilla';
        $promo->descripcion = '2 horas por 1';
        $promo->costo = 589.78;
        $promo->horas = 2;
        $promo->save();

        $promo2 = new Promo();
        $promo2->tipo = 'Sencilla';
        $promo2->descripcion = '3 horas por 2';
        $promo2->costo = 789.78;
        $promo2->horas = 3;
        $promo2->save();

        $promo3 = new Promo();
        $promo3->tipo = 'Sencilla';
        $promo3->descripcion = '5 horas por 3';
        $promo3->costo = 1089.78;
        $promo3->horas = 5;
        $promo3->save();

        $promo4 = new Promo();
        $promo4->tipo = 'Especial';
        $promo4->descripcion = 'Polvo e gallo';
        $promo4->costo = 389.78;
        $promo4->horas = 1;
        $promo4->save();

        $promo5 = new Promo();
        $promo5->tipo = 'Especial';
        $promo5->descripcion = 'Camioneros en la carretera';
        $promo5->costo = 589.78;
        $promo5->horas = 6;
        $promo5->save();

        $promo6 = new Promo();
        $promo6->tipo = 'Especial';
        $promo6->descripcion = 'Llanero solitario';
        $promo6->costo = 600.00;
        $promo6->horas = 7;
        $promo6->save();

        $promo7 = new Promo();
        $promo7->tipo = 'Matrimonial';
        $promo7->descripcion = 'Combo enamorados 4 horas';
        $promo7->costo = 589.78;
        $promo7->horas = 4;
        $promo7->save();

        $promo8 = new Promo();
        $promo8->tipo = 'Matrimonial';
        $promo8->descripcion = '3 horas por 2';
        $promo8->costo = 789.78;
        $promo8->horas = 3;
        $promo8->save();

        $promo9 = new Promo();
        $promo9->tipo = 'Matrimonial';
        $promo9->descripcion = 'Cachos por 5 horas';
        $promo9->costo = 1089.78;
        $promo9->horas = 5;
        $promo9->save();
    }
}