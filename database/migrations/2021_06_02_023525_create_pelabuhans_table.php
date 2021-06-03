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
            $table->unsignedBigInteger('pelabuhan_id');
            $table->foreign('pelabuhan_id')->references('id')->on('katalog_pelabuhans')->onDelete('cascade');
            $table->unsignedBigInteger('kapal_id');
            $table->foreign('kapal_id')->references('id')->on('katalog_kapals')->onDelete('cascade');
            $table->integer('quantity');
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
