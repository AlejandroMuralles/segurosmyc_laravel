<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaContactoCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('telefono')->nullable();
            $table->integer('celular')->nullable();
            $table->string('empresa_celular',1)->nullable();
            $table->string('correo',100)->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('cliente_id')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacto_cliente');
    }

}
