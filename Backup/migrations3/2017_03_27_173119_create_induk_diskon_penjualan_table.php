<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndukDiskonPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_induk_diskon_penjualan', function (Blueprint $table) {
            $table->increments('id_induk_diskon_penjualan');
            $table->datetime('tgl_berlaku');
            $table->datetime('tgl_berakhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_induk_diskon_penjualan');
    }
}
