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
        Schema::table('tb_log_diskon', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_diskon_item')->unsigned();
            $table->integer('id_diskon_AB')->unsigned();
            $table->integer('id_diskon_penjualan')->unsigned();

            //add constrain
            $table->foreign('id_diskon_item')
                  ->references('id_diskon_item')
                  ->on('tb_diskon_item');

            $table->foreign('id_diskon_AB')
                  ->references('id')
                  ->on('tb_diskon_Ab');

            $table->foreign('id_diskon_penjualan')
                  ->references('id_diskon_penjualan')
                  ->on('tb_diskon_penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_log_diskon');
    }
}
