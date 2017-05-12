<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarAPolizaPolizaAnteriorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza', function (Blueprint $table) {            
            $table->integer('poliza_anterior_id')->unsigned()->nullable();
            $table->foreign('poliza_anterior_id')->references('id')->on('poliza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza', function (Blueprint $table) {
            $table->dropForeign('poliza_poliza_anterior_id_foreign');
        });
    }
}
