<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonABTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_AB', function (Blueprint $table) {
            $table->integer('id_induk_diskon_item')->unsigned();
            $table->string('barcode_B','50');
            $table->string('nama_barang_diskon','100');
            $table->integer('qty_pembelian');
            $table->integer('qty_bonus');
            $table->enum('berlaku_kelipatan',['ya','tidak']);

            //add constrain
            $table->primary('id_induk_diskon_item');
            $table->foreign('id_induk_diskon_item')
                            ->references('id_induk_diskon_item')
                            ->on('tb_induk_diskon_item')
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
        Schema::dropIfExists('tb_diskon_AB');
    }
}
