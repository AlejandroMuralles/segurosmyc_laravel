<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaContactoAseguradora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_aseguradora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('telefono')->nullable();
            $table->integer('celular')->nullable();
            $table->string('empresa_celular',1)->nullable();
            $table->string('correo',100)->nullable();
            $table->integer('aseguradora_id')->unsigned();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('area_aseguradora_id')->unsigned();
            $table->string('extension',45)->nullable();
            $table->string('observaciones')->nullable();
            $table->string('zona',45);
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('aseguradora_id')->references('id')->on('aseguradora');
            $table->foreign('area_aseguradora_id')->references('id')->on('area_aseguradora');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_aseguradora');
    }
}
