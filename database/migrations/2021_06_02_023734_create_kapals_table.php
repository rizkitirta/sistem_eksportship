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
            $table->string('nama_kapal');
            $table->string('jenis_kapal');
            $table->string('Kecepatan');
            $table->string('berat_muatan');
            $table->string('daya_mesin');
            $table->string('letak_mesin');
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
