<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarPctFraccionamientoPolizaInclusion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_inclusion', function (Blueprint $table) {
            $table->double('pct_fraccionamiento')->after('poliza_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza_inclusion', function (Blueprint $table) {
            $table->dropColumn('pct_fraccionamiento');
        });
    }
}
