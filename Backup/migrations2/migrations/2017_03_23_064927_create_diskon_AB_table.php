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
        Schema::table('tb_diskon_AB', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode_A','50');
            $table->string('barcode_B','50');
            $table->integer('qty_pembelian');
            $table->integer('qty_bonus');
            $table->datetime('tgl_berlaku');
            $table->datetime('tgl_berakhir');

            //add constrain
            $table->foreign('barcode_A')
                  ->references('barcode')->on('tb_stok')
                  ->onDelete('restrict');

            $table->foreign('barcode_B')
                  ->references('barcode')->on('tb_stok')
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
