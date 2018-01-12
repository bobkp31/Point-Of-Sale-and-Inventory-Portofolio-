<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pemasok', function (Blueprint $table) {
            $table->string('id_pemasok','50');
            $table->string('nama_pemasok','150');
            $table->enum('status',['Aktif','Di Hapus']);

            //add constrain
            $table->primary('id_pemasok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pemasok');
    }
}
