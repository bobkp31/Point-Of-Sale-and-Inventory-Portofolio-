<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_stok', function (Blueprint $table) {
          $table->increments('id_stok');
          $table->string('barcode','50');
          $table->string('kd_barang','50')->nullable();
          $table->string('nama_barang','150');
          $table->double('hpp');
          $table->double('harga_jual');
          $table->integer('jumlah');
          $table->integer('stok_minimum');
          $table->enum('status',['Aktif','Di Hapus']);


          //set constrain
          $table->unique('barcode','50');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_stok');
    }
}
