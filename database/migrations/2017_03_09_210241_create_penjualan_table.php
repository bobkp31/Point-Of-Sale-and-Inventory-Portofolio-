<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjualan', function (Blueprint $table) {
            // $table->increments('id');
            // $table->timestamps();

            $table->increments('no_penjualan');
            $table->string('id_pegawai','150');
            $table->integer('id_pelanggan')->unsigned()->nullable();
            $table->dateTime('waktu');
            $table->double('total');
            $table->double('pajak');
            $table->enum('jenis_pembayaran',['tunai','debit']);
            $table->double('nominal_pembayaran');

            //relationship
            // $table->foreign('id_pelanggan')
            //       ->references('id_pelanggan')->on('tb_pelanggan')
            //       ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penjualan');
    }
}
