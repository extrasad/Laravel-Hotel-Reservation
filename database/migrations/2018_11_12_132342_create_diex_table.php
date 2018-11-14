<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diexes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('placa')->nullable();
            $table->string('ci')->nullable();
            $table->string('nombre')->nullable();
            $table->enum('estado', array('Advertencia', 'Solicitado'));
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('diex');
    }
}
