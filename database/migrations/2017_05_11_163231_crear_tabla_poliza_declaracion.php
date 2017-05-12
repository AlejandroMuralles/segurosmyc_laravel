<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaDeclaracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_declaracion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('endoso',45)->nullable();
            $table->integer('poliza_id')->unsigned();
            $table->datetime('fecha_solicitud');
            $table->datetime('fecha_aprobada')->nullable();
            $table->integer('petrolera_id')->unsigned()->nullable();
            $table->double('galones')->nullable();
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_id')->references('id')->on('poliza');
            $table->foreign('petrolera_id')->references('id')->on('petrolera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poliza_declaracion');
    }
}
