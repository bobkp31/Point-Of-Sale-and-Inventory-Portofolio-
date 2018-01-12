<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_penjualan', function (Blueprint $table) {
          $table->increments('id_diskon_penjualan');
          $table->integer('no_penjualan')->unsigned();
          $table->double('minimum_pembelian');
          $table->float('persentase');
          $table->double('nilai');
          $table->datetime('tgl_berlaku');
          $table->datetime('tgl_berakhir');

          $table->foreign('no_penjualan')
                ->references('no_penjualan')->on('tb_penjualan')
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
        Schema::dropIfExists('tb_diskon_penjualan');
    }
}
