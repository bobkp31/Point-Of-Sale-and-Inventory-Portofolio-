<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbBarangPemasok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_barang_pemasok', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pemasok','150');
            $table->integer('id_barang')->unsigned();

            //add constrain
            $table->foreign('nama_pemasok')
                  ->references('nama_pemasok')->on('tb_pemasok');

            $table->foreign('id_barang')
                  ->references('id')->on('tb_barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_barang_pemasok');
    }
}
