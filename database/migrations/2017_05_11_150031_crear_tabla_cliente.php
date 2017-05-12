<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('nit',10);
            $table->integer('pais_fiscal_id')->unsigned();
            $table->integer('departamento_fiscal_id')->unsigned();
            $table->integer('municipio_fiscal_id')->unsigned();
            $table->string('direccion_fiscal');
            $table->integer('zona_fiscal');
            $table->string('representante_legal')->nullable();
            $table->string('dpi',13);
            $table->string('telefonos',45);
            $table->string('nombre_facturacion');
            $table->string('nit_facturacion',10);
            $table->integer('pais_facturacion_id')->unsigned();
            $table->integer('departamento_facturacion_id')->unsigned();
            $table->integer('municipio_facturacion_id')->unsigned();
            $table->string('direccion_facturacion');
            $table->integer('zona_facturacion');
            $table->string('correo',100)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('pais_correspondencia_id')->unsigned()->nullable();
            $table->integer('departamento_correspondencia_id')->unsigned()->nullable();
            $table->integer('municipio_correspondencia_id')->unsigned()->nullable();
            $table->string('direccion_correspondencia')->nullable();
            $table->integer('zona_correspondencia')->nullable();
            $table->string('profesion',100)->nullable();
            $table->string('genero',1)->nullable();
            $table->string('tipo_actividad',100)->nullable();
            $table->string('oficio',100)->nullable();
            $table->integer('consorcio_id')->unsigned()->nullable();
            $table->string('tipo_cliente',1);
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('pais_fiscal_id')->references('id')->on('pais');
            $table->foreign('departamento_fiscal_id')->references('id')->on('departamento');
            $table->foreign('municipio_fiscal_id')->references('id')->on('municipio');
            $table->foreign('pais_facturacion_id')->references('id')->on('pais');
            $table->foreign('departamento_facturacion_id')->references('id')->on('departamento');
            $table->foreign('municipio_facturacion_id')->references('id')->on('municipio');
            $table->foreign('pais_correspondencia_id')->references('id')->on('pais');
            $table->foreign('departamento_correspondencia_id')->references('id')->on('departamento');
            $table->foreign('municipio_correspondencia_id')->references('id')->on('municipio');
            $table->foreign('consorcio_id')->references('id')->on('consorcio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
