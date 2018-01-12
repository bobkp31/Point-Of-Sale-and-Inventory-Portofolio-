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
          $table->string('barcode','50');
          $table->string('kd_barang','50');
          $table->string('nama_barang','150');
          $table->double('harga_jual');
          $table->integer('jumlah');
          


          //set constrain
          $table->primary('barcode','50');
          $table->unique('kd_barang','50');
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
