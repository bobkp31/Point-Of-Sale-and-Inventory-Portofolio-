<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi_penjualan', function (Blueprint $table) {
            $table->increments('id_transaksi_penjualan');
            $table->integer('id_transaksi')->unsigned();
            $table->integer('no_penjualan')->unsigned();
            $table->enum('status',['proses','berhasil','batal','simpan']);

            //add constrain
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')->on('tb_transaksi')
                  ->onDelete('restrict');

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
        Schema::dropIfExists('tb_transaksi_penjualan');
    }
}
