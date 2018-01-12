<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndukDiskonItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_induk_diskon_item', function (Blueprint $table) {
            $table->increments('id_induk_diskon_item');
            $table->string('barcode','50');
            $table->datetime('tgl_berlaku');
            $table->datetime('tgl_berakhir');

            //add constrain
            $table->foreign('barcode')
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
        Schema::dropIfExists('tb_induk_diskon_item');
    }
}
