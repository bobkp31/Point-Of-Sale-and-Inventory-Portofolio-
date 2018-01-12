<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartKepegawainTbPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::connection('aditiyamart_kepegawaian')
             ->create('tb_pegawai', function (Blueprint $table) {
                     $table->increments('id');
                     $table->string('nip','150');
                     $table->string('nama','150');
                     $table->string('alamat','150');
                     $table->integer('id_jabatan')->unsigned();
                     $table->date('tgl_lahir');
                     $table->enum('status_kepegawaian',['aktif','berhenti']);
                     $table->timestamps();

                     //add constrain
                     $table->unique('nip');
                     $table->foreign('id_jabatan')
                           ->references('id')
                           ->on('tb_jabatan');

         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::connection('aditiyamart_kepegawaian')->dropIfExists('tb_pegawai');
     }

}
