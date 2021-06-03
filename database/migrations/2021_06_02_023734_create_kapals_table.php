<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKapalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kapals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kapal_id');
            $table->foreign('kapal_id')->references('id')->on('katalog_kapals')->onDelete('cascade');
            $table->unsignedBigInteger('container_id');
            $table->foreign('container_id')->references('id')->on('katalog_containers')->onDelete('cascade');
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
        Schema::dropIfExists('kapals');
    }
}
