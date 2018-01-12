<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjualan', function (Blueprint $table) {
            // $table->increments('id');
            // $table->timestamps();

            $table->increments('no_penjualan');
            $table->string('barcode','50');
            $table->integer('id_pegawai')->unsigned();
            $table->string('id_pelanggan','50')->nullable();
            $table->integer('qty');
            $table->dateTime('waktu');

            //relationship
            $table->foreign('barcode')
                  ->references('barcode')->on('tb_stok')
                  ->onDelete('restrict');

            $table->foreign('id_pegawai')
                  ->references('id_pegawai')->on('tb_pegawai')
                  ->onDelete('restrict');

            $table->foreign('id_pelanggan')
                  ->references('id_pelanggan')->on('tb_pelanggan')
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
        Schema::dropIfExists('tb_penjualan');
    }
}
