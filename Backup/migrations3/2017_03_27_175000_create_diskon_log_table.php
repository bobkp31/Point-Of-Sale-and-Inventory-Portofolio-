<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_induk_diskon_item')->unsigned()->nullable();
            $table->integer('id_induk_diskon_penjualan')->unsigned()->nullable();

            //add Constrain

            $table->foreign('id_induk_diskon_item')
                  ->references('id_induk_diskon_item')
                  ->on('tb_induk_diskon_item')
                  ->onDelete('restrict');

            $table->foreign('id_induk_diskon_penjualan')
                  ->references('id_induk_diskon_penjualan')
                  ->on('tb_induk_diskon_penjualan')
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
        Schema::dropIfExists('tb_diskon_log');
    }
}
