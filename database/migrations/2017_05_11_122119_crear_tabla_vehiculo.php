<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaVehiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_placa',2);
            $table->string('placa',10);
            $table->integer('tipo_vehiculo_id')->unsigned();
            $table->integer('modelo');
            $table->integer('marca_id')->unsigned();
            $table->string('linea',50);
            $table->string('color',45);
            $table->string('numero_motor',100);
            $table->string('numero_chasis',100);
            $table->integer('numero_asientos');
            $table->double('cilindraje');
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculo');
            $table->foreign('marca_id')->references('id')->on('marca_vehiculo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo');
    }
}
