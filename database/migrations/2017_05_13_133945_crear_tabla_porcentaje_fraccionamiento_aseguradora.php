<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPorcentajeFraccionamientoAseguradora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('porcentaje_fraccionamiento_aseguradora', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad_pagos');
            $table->double('porcentaje');
            $table->integer('aseguradora_id')->unsigned();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('aseguradora_id')->references('id')->on('aseguradora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('porcentaje_fraccionamiento_aseguradora');
    }
}
