<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBitacoraPoliza extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacora_poliza', function (Blueprint $table) {
            $table->increments('id');
            $table->string('observaciones',400);
            $table->integer('poliza_id')->unsigned();
            $table->integer('poliza_inclusion_id')->unsigned()->nullable();
            $table->integer('poliza_exclusion_id')->unsigned()->nullable();
            $table->string('estado_poliza',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_id')->references('id')->on('poliza');
            $table->foreign('poliza_inclusion_id')->references('id')->on('poliza_inclusion');
            $table->foreign('poliza_exclusion_id')->references('id')->on('poliza_exclusion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora_poliza');
    }
}
