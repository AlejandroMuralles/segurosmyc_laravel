<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaRequerimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_requerimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('poliza_id')->unsigned();
            $table->date('fecha_cobro');
            $table->date('fecha_pago')->nullable();
            $table->integer('cuota');
            $table->double('prima_neta');
            $table->double('asistencia');
            $table->double('iva');
            $table->double('pct_descuento')->nullable();
            $table->double('descuento')->nullable();
            $table->double('fraccionamiento');
            $table->double('emision');
            $table->double('prima_total');
            $table->string('estado',1);
            $table->integer('poliza_inclusion_id')->unsigned()->nullable();
            $table->integer('motivo_anulacion_id')->unsigned()->nullable();
            $table->datetime('fecha_anulacion')->nullable();
            $table->double('pago_pendiente');
            $table->integer('poliza_declaracion_id')->unsigned()->nullable();
            $table->integer('planilla_id')->unsigned()->nullable();
            $table->string('observaciones',300)->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->foreign('poliza_id')->references('id')->on('poliza');
            $table->foreign('poliza_inclusion_id')->references('id')->on('poliza_inclusion');
            $table->foreign('motivo_anulacion_id')->references('id')->on('motivo_anulacion');
            $table->foreign('poliza_declaracion_id')->references('id')->on('poliza_declaracion');
            $table->foreign('planilla_id')->references('id')->on('planilla');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza_requerimiento');
    }
}
