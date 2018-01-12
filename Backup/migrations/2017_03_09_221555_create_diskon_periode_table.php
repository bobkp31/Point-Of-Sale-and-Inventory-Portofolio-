<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonPeriodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_periode', function (Blueprint $table) {
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->integer('id_diskon_item')->nullable()->unsigned();
            $table->integer('id_diskon_penjualan')->nullable()->unsigned();
            $table->integer('id_diskon_pemasok')->nullable()->unsigned();

            //add constrain

            $table->foreign('id_diskon_item')
                  ->references('id_diskon_item')->on('tb_diskon_item')
                  ->onDelete('restrict');

            $table->foreign('id_diskon_penjualan')
                  ->references('id_diskon_penjualan')->on('tb_diskon_penjualan')
                  ->onDelete('restrict');

            $table->foreign('id_diskon_pemasok')
                  ->references('id_diskon_pemasok')->on('tb_diskon_pemasok')
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
        Schema::drop('tb_diskon_periode');
    }
}
