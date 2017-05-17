<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNotaCredito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_credito', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_documento',45);
            $table->text('observaciones');
            $table->integer('poliza_id')->unsigned();
            $table->integer('poliza_exclusion_id')->unsigned()->nullable();
            $table->datetime('fecha');
            $table->double('monto');
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('poliza_id')->references('id')->on('poliza');
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
        Schema::dropIfExists('nota_credito');
    }
}
