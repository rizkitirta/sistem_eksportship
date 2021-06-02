<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kapal_id');
            $table->foreign('kapal_id')->references('id')->on('kapals')->onDelete('cascade');
            $table->unsignedBigInteger('asal');
            $table->foreign('asal')->references('id')->on('pelabuhans')->onDelete('cascade');
            $table->unsignedBigInteger('tujuan');
            $table->foreign('tujuan')->references('id')->on('pelabuhans')->onDelete('cascade');
            $table->integer('jumlah_container')->nullable();
            $table->string('deskripsi')->nullable();

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
        Schema::dropIfExists('data_pengiriman');
    }
}
