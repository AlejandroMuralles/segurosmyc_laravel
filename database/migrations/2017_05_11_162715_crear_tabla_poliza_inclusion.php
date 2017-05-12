<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaInclusion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_inclusion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('endoso',45)->nullable();
            $table->integer('poliza_id')->unsigned();
            $table->datetime('fecha_solicitud');
            $table->datetime('fecha_aprobada')->nullable();
            $table->datetime('fecha_rechazada')->nullable();
            $table->string('estado',1);
            $table->integer('motivo_anulacion_id')->unsigned()->nullable();
            $table->datetime('fecha_anulacion')->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_id')->references('id')->on('poliza');
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
        Schema::dropIfExists('poliza_inclusion');
    }
}
