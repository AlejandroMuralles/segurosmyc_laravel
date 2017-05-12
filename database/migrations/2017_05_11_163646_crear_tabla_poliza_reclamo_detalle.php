<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaReclamoDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_reclamo_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliza_vehiculo_reclamo_id')->unsigned();
            $table->integer('cobertura_id')->unsigned();
            $table->double('valor');
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_vehiculo_reclamo_id')->references('id')->on('poliza_vehiculo_reclamo');
            $table->foreign('cobertura_id')->references('id')->on('cobertura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza_reclamo_detalle');
    }
}
