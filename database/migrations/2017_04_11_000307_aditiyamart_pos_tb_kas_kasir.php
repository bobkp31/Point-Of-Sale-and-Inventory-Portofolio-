<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartPosTbKasKasir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kas_kasir', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username','150');
            $table->double('setoran');
            $table->double('rekap');
            $table->dateTime('waktu_setor')->nullable();
            $table->dateTime('waktu_rekap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kas_kasir');
    }
}
