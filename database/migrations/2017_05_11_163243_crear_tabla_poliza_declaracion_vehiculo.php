<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaDeclaracionVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_declaracion_vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliza_declaracion_id')->unsigned()->nullable();
            $table->integer('poliza_vehiculo_id')->unsigned()->nullable();
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_declaracion_id')->references('id')->on('poliza_declaracion');
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
        Schema::dropIfExists('poliza_declaracion_vehiculo');
    }
}
