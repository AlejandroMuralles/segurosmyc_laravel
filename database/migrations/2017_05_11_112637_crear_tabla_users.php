<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',45);
            $table->string('password');
            $table->string('email',100)->nullable();
            $table->integer('colaborador_id')->unsigned();
            $table->tinyInteger('primera_vez');
            $table->integer('perfil_id')->unsigned();
            $table->string('remember_token')->nullable();
            $table->string('estado',1);
            $table->timestamps();
            $table->string('created_by',45);
            $table->string('updated_by',45);

            $table->foreign('colaborador_id')->references('id')->on('colaborador');
            $table->foreign('perfil_id')->references('id')->on('perfil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
