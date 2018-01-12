<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStokPemasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_stok_pemasok', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_pemasok','50');
            $table->string('barcode','50');
            $table->enum('status',['Aktif','Di Hapus']);

            //add constrain
            $table->foreign('id_pemasok')
                  ->references('id_pemasok')->on('tb_pemasok')
                  ->onDelete('restrict');

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
        Schema::dropIfExists('tb_stok_pemasok');
    }
}
