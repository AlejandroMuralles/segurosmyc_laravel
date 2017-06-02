<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPoliza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero',45)->nullable();
            $table->string('estado',1);
            $table->integer('aseguradora_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('cantidad_pagos');
            $table->integer('ejecutivo_id')->unsigned();
            $table->integer('dueno_id')->unsigned();
            $table->integer('frecuencia_pago_id')->unsigned();
            $table->integer('tipo_pago_id')->unsigned()->nullable();
            $table->string('anual_declarativa',1);
            $table->double('pct_iva');
            $table->double('pct_fraccionamiento');
            $table->double('pct_emision');
            $table->datetime('fecha_solicitud');
            $table->datetime('fecha_aprobada')->nullable();
            $table->datetime('fecha_anulada')->nullable();
            $table->datetime('fecha_renovada')->nullable();
            $table->integer('motivo_anulacion_id')->unsigned()->nullable();
            $table->datetime('fecha_anulacion')->nullable();
            $table->integer('ramo_id')->unsigned();
            $table->string('ruta',45);
            $table->string('ruta_solicitud',45);
            $table->string('dirigida_a')->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('aseguradora_id')->references('id')->on('aseguradora');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('ejecutivo_id')->references('id')->on('colaborador');
            $table->foreign('dueno_id')->references('id')->on('colaborador');
            $table->foreign('frecuencia_pago_id')->references('id')->on('frecuencia_pago');
            $table->foreign('motivo_anulacion_id')->references('id')->on('motivo_anulacion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza');
    }
}