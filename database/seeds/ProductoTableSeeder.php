<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $producto = new Producto();
        $producto->descripcion = 'Pepitos';
        $producto->costo = 589.78;
        $producto->save();

        $producto2 = new Producto();
        $producto2->descripcion = 'Ruffles';
        $producto2->costo = 789.78;
        $producto2->save();

        $producto3 = new Producto();
        $producto3->descripcion = 'Mani Jack Japones';
        $producto3->costo = 1089.78;
        $producto3->save();

        $producto4 = new Producto();
        $producto4->descripcion = 'Condones Te Amo';
        $producto4->costo = 389.78;
        $producto4->save();

        $producto5 = new Producto();
        $producto5->descripcion = 'Nucita';
        $producto5->costo = 589.78;
        $producto->save();

        $producto6 = new Producto();
        $producto6->descripcion = 'Cheese Tris';
        $producto6->costo = 789.78;
        $producto6->horas = 3;
        $producto6->save();

        $producto7 = new Producto();
        $producto7->descripcion = 'Snickers';
        $producto7->costo = 1089.78;
        $producto7->save();

        $producto8 = new Producto();
        $producto8->descripcion = 'Rosquitas';
        $producto8->costo = 389.78;
        $producto8->save();

        $producto9 = new Producto();
        $producto9->descripcion = 'Milky way';
        $producto9->costo = 589.78;
        $producto9->save();

        $producto10 = new Producto();
        $producto10->descripcion = 'Santa teresa';
        $producto10->costo = 789.78;
        $producto10->save();

    }
}