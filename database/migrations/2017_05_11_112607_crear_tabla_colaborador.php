<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaColaborador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaborador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('sexo',1);
            $table->string('foto');
            $table->integer('puesto_id')->unsigned();
            $table->date('fecha_nacimiento');
            $table->string('telefono',45)->nullable();
            $table->string('celular',45)->nullable();
            $table->string('email',100)->nullable();
            $table->time('horario_entrada');
            $table->double('sueldo_base');
            $table->string('dpi',14);
            $table->integer('dias_vacaciones');
            $table->date('fecha_ingreso');
            $table->tinyInteger('en_nomina');
            $table->tinyInteger('aplica_igss');
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('puesto_id')->references('id')->on('puesto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colaborador');
    }
}
