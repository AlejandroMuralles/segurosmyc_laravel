<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPolizaModificacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliza_modificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poliza_id')->unsigned();
            $table->date('fecha_solicitud');
            $table->date('fecha_aprobada')->nullable();
            $table->string('estado',1);
            $table->string('endoso',45);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

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
        Schema::dropIfExists('poliza_modificacion');
    }
}
