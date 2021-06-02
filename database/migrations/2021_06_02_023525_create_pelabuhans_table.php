<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelabuhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelabuhans', function (Blueprint $table) {
            $table->id();
            $table->string('negara');
            $table->string('lokasi');
            $table->string('operator');
            $table->string('jenis_pelabuhan');
            $table->string('otoritas_pelabuhan')->nullable();
            $table->string('menghubungkan_ke');
            $table->string('jenis_dermaga');
            $table->string('kedatangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelabuhans');
    }
}
