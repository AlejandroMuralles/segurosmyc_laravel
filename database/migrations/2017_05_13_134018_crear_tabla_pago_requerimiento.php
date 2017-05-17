<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPagoRequerimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_requerimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pago_id')->unsigned();
            $table->integer('requerimiento_id')->unsigned();
            $table->double('monto');
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('pago_id')->references('id')->on('pago');
            $table->foreign('requerimiento_id')->references('id')->on('poliza_requerimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_requerimiento');
    }
}
