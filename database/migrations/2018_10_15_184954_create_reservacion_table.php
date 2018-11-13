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
        Schema::create('reservacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('habitacion_id')->nullable();
            $table->integer('auto_id')->nullable();
            $table->integer('cliente1_id')->nullable();
            $table->integer('cliente2_id')->nullable();
            $table->float('costo')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->string('observacion')->nullable();
            $table->enum('estado', array('Activa', 'Inactiva'));
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
