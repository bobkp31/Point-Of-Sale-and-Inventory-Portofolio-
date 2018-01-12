<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonPelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_pelanggan', function (Blueprint $table) {
          $table->integer('id_induk_diskon_penjualan')->unsigned();
          $table->integer('point');
          $table->double('minimum_pembelian');
          $table->double('persentase');
          $table->double('nilai');

          //add constrain
          $table->primary('id_induk_diskon_penjualan');
          $table->foreign('id_induk_diskon_penjualan')
                ->references('id_induk_diskon_penjualan')
                ->on('tb_induk_diskon_penjualan')
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
        Schema::dropIfExists('tb_diskon_pelanggan');
    }
}
