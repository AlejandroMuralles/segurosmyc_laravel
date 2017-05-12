<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPlanilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('aseguradora_id')->unsigned();
            $table->integer('tipo');
            $table->integer('poliza_id')->unsigned()->nullable();
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('aseguradora_id')->references('id')->on('aseguradora');
            $table->foreign('poliza_id')->references('id')->on('poliza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planilla');
    }
}
