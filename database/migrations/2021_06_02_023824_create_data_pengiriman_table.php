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
            $table->foreign('kapal_id')->references('id')->on('katalog_kapals')->onDelete('cascade');
            $table->unsignedBigInteger('pelabuhan_id');
            $table->foreign('pelabuhan_id')->references('id')->on('katalog_pelabuhans')->onDelete('cascade');
            $table->integer('qty_kapal')->nullable();
            $table->date('tgl_pengiriman');
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('statuses')->onDelete('cascade');
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
