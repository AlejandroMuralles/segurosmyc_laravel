<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaCoberturaVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_cobertura_vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado',2);
            $table->integer('poliza_vehiculo_id')->unsigned();
            $table->integer('cobertura_id')->unsigned();
            $table->double('suma_asegurada');
            $table->double('porcentaje_deducible');
            $table->double('deducible');
            $table->double('deducible_minimo');
            $table->integer('poliza_id')->unsigned();
            $table->integer('vehiculo_id')->unsigned();
            $table->integer('poliza_inclusion_id')->unsigned()->nullable();
            $table->datetime('fecha_inclusion');
            $table->integer('poliza_exclusion_id')->unsigned()->nullable();
            $table->datetime('fecha_exclusion')->nullable();
            
            $table->integer('motivo_anulacion_id')->unsigned()->nullable();
            $table->datetime('fecha_anulacion')->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_vehiculo_id')->references('id')->on('poliza_vehiculo');
            $table->foreign('cobertura_id')->references('id')->on('cobertura');
            $table->foreign('poliza_id')->references('id')->on('poliza');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculo');
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
        Schema::dropIfExists('poliza_cobertura_vehiculo');
    }
}
