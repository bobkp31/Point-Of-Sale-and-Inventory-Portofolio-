<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbFaktur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_faktur', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_faktur','150');
            $table->string('no_order','150')->nullable();
            $table->date('tanggal_order')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->double('total_harga')->nullable();
            $table->double('total_potongan')->nullable();
            $table->double('total_tagihan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('nama_pemasok','150');
            $table->dateTime('waktu_input')->nullable();
            $table->string('nip');
            $table->enum('status_input',['proses','berhasil']);
            $table->enum('status_pembayaran',['belum','tunai','kredit']);

            $table->index('no_faktur');
            $table->foreign('nama_pemasok')
                    ->references('nama_pemasok')
                    ->on('tb_pemasok')
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
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_faktur');
    }
}
