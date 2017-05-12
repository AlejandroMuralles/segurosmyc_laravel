<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaVehiculoReclamo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_vehiculo_reclamo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_aviso',45);
            $table->string('numero',45);            
            $table->integer('poliza_vehiculo_id')->unsigned();
            $table->string('observaciones');
            $table->double('valor');
            $table->datetime('fecha_solicitud');
            $table->string('estado',1);
            $table->string('ajustador',100)->nullable();
            $table->string('reportante',100)->nullable();
            $table->string('piloto',100)->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_vehiculo_id')->references('id')->on('poliza_vehiculo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza_vehiculo_reclamo');
    }
}
