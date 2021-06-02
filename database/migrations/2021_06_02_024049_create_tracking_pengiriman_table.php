<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kapal_id');
            $table->foreign('kapal_id')->references('id')->on('kapals')->onDelete('cascade');
            $table->unsignedBigInteger('lokasi_sekarang');
            $table->foreign('lokasi_sekarang')->references('id')->on('pelabuhans')->onDelete('cascade');
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
        Schema::dropIfExists('tracking_pengiriman');
    }
}
