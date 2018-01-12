<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbRiwayatFaktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_riwayat_faktur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode','100');
            $table->string('no_faktur','150');
            $table->double('harga_selisih');
            $table->double('harga_rata_rata');
            $table->integer('stok_sebelum_update');
            $table->integer('stok_sesudah_update');
            $table->date('masa_barlaku');
            $table->datetime('waktu_input');

            $table->index('no_faktur');
            $table->foreign('no_faktur')
                    ->references('no_faktur')
                    ->on('tb_faktur')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_riwayat_faktur');
    }
}
