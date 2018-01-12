<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbKirimBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_kirim_barang', function (Blueprint $table) {
              $table->increments('id');
              $table->datetime('waktu');
              $table->string('nip');
              $table->string('nama_toko');
              $table->enum('status_pengiriman',['proses','terkirim']);
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
