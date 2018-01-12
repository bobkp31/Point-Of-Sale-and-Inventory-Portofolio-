<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailDiskonPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_diskon_penjualan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_penjualan')->unsigned();
            $table->integer('id_induk_diskon_penjualan')->unsigned();
            $table->double('total');

            $table->foreign('no_penjualan')
                  ->references('no_penjualan')->on('tb_penjualan')
                  ->onDelete('restrict');

            $table->foreign('id_induk_diskon_penjualan')
                  ->references('id_induk_diskon_penjualan')->on('tb_induk_diskon_penjualan')
                  ->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_detail_diskon_penjualan');
    }
}
