<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbDetailFaktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_detail_faktur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode','100');
            $table->integer('id_faktur')->unsigned();
            $table->integer('jumlah_barang');
            $table->double('harga_satuan');

            //
            $table->index('barcode');

            $table->foreign('id_faktur')
                    ->references('id')
                    ->on('tb_faktur')
                    ->onDelete('restrict');

            $table->foreign('barcode')
                    ->references('barcode')
                    ->on('tb_barcode')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_detail_faktur');
    }
}
