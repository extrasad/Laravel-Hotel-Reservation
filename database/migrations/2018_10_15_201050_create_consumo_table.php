<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto')->unsigned();
            $table->foreign('producto')
            ->references('id')->on('productos')
            ->onDelete('cascade');
            $table->integer('reservacion')->unsigned();
            $table->foreign('reservacion')
            ->references('id')->on('reservaciones')
            ->onDelete('cascade');
            $table->float('costo');
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', array('Pendiente por pagar', 'Cancelado'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumos');
    }
}
