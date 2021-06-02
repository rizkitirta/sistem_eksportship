<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogPelabuhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog_pelabuhans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelabuhan');
            $table->string('lokasi_pelabuhan');
            $table->string('jenis_pelabuhan');
            $table->string('menghubungkan_ke');
            $table->string('kedatangan_kapal');
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
        Schema::dropIfExists('katalog_pelabuhans');
    }
}
