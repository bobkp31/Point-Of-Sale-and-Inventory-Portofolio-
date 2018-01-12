<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->string('NIP','50');
            $table->string('nama_pegawai','150');
            $table->enum('jabatan', ['Manager','Asisten manager',
                                     'Pramuniaga','Kasir','Kepala toko']
                        );
            $table->enum('status', ['Aktif','Tidak Aktif']);

            //add constrain
            $table->unique('NIP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawai');
    }
}
