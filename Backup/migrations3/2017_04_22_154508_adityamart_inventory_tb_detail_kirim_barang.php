<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdityamartInventoryTbDetailKirimBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')->create('tb_detail_kirim_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode','100');
            $table->integer('id_kirim_barang')->unsigned();
            $table->integer('jumlah');

            //constrain
            $table->foreign('barcode');
                  ->references('barcode')->on('tb_barang')
                  ->onDelete('restrict');

            $table->foreign('id_kirim_barang');
                  ->references('id')->on('tb_kirim_barang')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_kirim_barang');
    }
}
