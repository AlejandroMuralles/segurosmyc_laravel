<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProductoCobertura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_cobertura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->integer('aseguradora_id')->unsigned();
            $table->tinyInteger('amparada')->nullable();
            $table->double('suma_asegurada')->nullable();
            $table->double('pct_deducible')->nullable();
            $table->double('deducible_minimo')->nullable();
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('producto_id')->references('id')->on('producto');
            $table->foreign('aseguradora_id')->references('id')->on('aseguradora');
            $table->unique(['producto_id','aseguradora_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_cobertura');
    }
}
