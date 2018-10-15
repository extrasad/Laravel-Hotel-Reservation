<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('habitacion')->unsigned();
            $table->foreign('habitacion')
            ->references('id')->on('habitaciones')
            ->onDelete('cascade');
            $table->integer('placa')->unsigned();
            $table->foreign('placa')
            ->references('id')->on('autos')
            ->onDelete('cascade');
            $table->integer('ci')->unsigned();
            $table->foreign('ci')
            ->references('id')->on('clientes')
            ->onDelete('cascade');
            $table->integer('ci2')->unsigned();
            $table->foreign('ci2')
            ->references('id')->on('clientes')
            ->onDelete('cascade');
            $table->float('costo');
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->string('observacion');
            $table->enum('estado', array('Advertencia', 'Solicitado'));
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
        Schema::dropIfExists('reservaciones');
    }
}
