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
          $table->integer('id_induk_diskon_penjualan')->unsigned();
          $table->double('minimum_pembelian');
          $table->enum('nilai_diskon',['persentase','rupiah']);
          $table->float('persentase')->nullable();
          $table->double('rupiah')->nullable();

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
        Schema::dropIfExists('tb_diskon_penjualan');
    }
}
