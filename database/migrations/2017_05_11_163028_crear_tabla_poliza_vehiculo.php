<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehiculo_id')->unsigned();
            $table->integer('poliza_id')->unsigned();
            $table->string('numero_certificado',50);
            $table->double('prima_neta');
            $table->double('suma_asegurada');
            $table->double('suma_asegurada_blindaje')->nullable();
            $table->double('asistencia')->nullable();
            $table->double('pct_deducible_robo')->nullable();
            $table->double('deducible_minimo_robo')->nullable();
            $table->double('pct_deducible_dano')->nullable();
            $table->double('deducible_minimo_dano')->nullable();
            $table->double('pct_iva');
            $table->double('iva');
            $table->double('fraccionamiento');
            $table->double('pct_fraccionamiento');
            $table->double('emision');
            $table->double('pct_emision');
            $table->double('prima_total');
            $table->integer('poliza_inclusion_id')->unsigned()->nullable();
            $table->datetime('fecha_inclusion');
            $table->integer('poliza_exclusion_id')->unsigned()->nullable();
            $table->datetime('fecha_exclusion')->nullable();
            $table->string('estado',2);
            $table->integer('motivo_anulacion_id')->unsigned()->nullable();
            $table->datetime('fecha_anulacion')->nullable();
            $table->string('activo_declaracion',1);
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('vehiculo_id')->references('id')->on('vehiculo');
            $table->foreign('poliza_id')->references('id')->on('poliza');
            $table->foreign('poliza_inclusion_id')->references('id')->on('poliza_inclusion');
            $table->foreign('poliza_exclusion_id')->references('id')->on('poliza_exclusion');
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
        Schema::dropIfExists('poliza_vehiculo');
    }
}
