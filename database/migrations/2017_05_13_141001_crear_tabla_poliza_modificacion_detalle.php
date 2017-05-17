<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaModificacionDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_modificacion_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliza_modificacion_id')->unsigned();
            $table->integer('tipo_poliza_modificacion_id')->unsigned();
            $table->string('cambio',200);
            $table->integer('solicitante');
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_modificacion_id')->references('id')->on('poliza_modificacion');
            $table->foreign('tipo_poliza_modificacion_id')->references('id')->on('tipo_poliza_modificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza_modificacion_detalle');
    }
}
