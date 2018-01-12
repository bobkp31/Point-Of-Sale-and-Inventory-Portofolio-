<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdityamartInventoryTbBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kategori','100');
            $table->string('nama_barang','150');
            $table->double('hpp');
            $table->double('harga_jual');
            $table->integer('stok_tersedia')->nullable();
            $table->integer('stok_minimum');

            //constrain
            $table->foreign('kategori')
                    ->references('kategori')
                    ->on('tb_kategori')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_barang');
    }
}
