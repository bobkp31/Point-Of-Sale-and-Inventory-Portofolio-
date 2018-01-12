<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdityamartInventoryTbDetailTambahStokBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
              ->create('tb_detail_tambah_stok_barang', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('id_tambah_stok')->unsigned();
              $table->integer('id_masa_berlaku')->unsigned();
              $table->string('barcode','100');
              $table->integer('jumlah');

              //add constrain
              $table->foreign('barcode')
                    ->references('barcode')->on('tb_barang')
                    ->onDelete('restrict');

              $table->foreign('id_tambah_stok')
                    ->references('id')->on('tb_tambah_stok')
                    ->onDelete('restrict');

              $table->foreign('id_masa_berlaku')
                    ->references('id')->on('tb_masa_berlaku')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_detail_tambah_stok_barang');
    }
}
