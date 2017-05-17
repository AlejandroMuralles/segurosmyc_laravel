<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaUbicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_ubicacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliza_id')->unsigned();
            $table->string('direccion',300);
            $table->string('numero_certificado',45)->nullable();
            $table->datetime('fecha_inclusion');
            $table->integer('poliza_inclusion_id')->unsigned()->nullable();
            $table->datetime('fecha_exclusion')->nullable();
            $table->integer('poliza_exclusion_id')->unsigned()->nullable();
            $table->double('pct_iva');
            $table->double('prima_total');
            $table->string('estado',1);
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
        Schema::dropIfExists('poliza_ubicacion');
    }
}
