<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartKepegawainTbAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::connection('aditiyamart_kepegawaian')
                 ->create('tb_akun', function (Blueprint $table)
         {
             $table->increments('id');
             $table->string('nip','150');
             $table->string('username','150');
             $table->string('password','150');
             $table->enum('hak_akses',['Owner','Manager',
                                       'Asisten Manager','Kasir']);
             $table->enum('status',['aktif','di hapus']);
             $table->timestamps();

             //add constrain
             $table->unique('username');
             $table->foreign('nip')
                   ->references('nip')
                   ->on('tb_pegawai');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::connection('aditiyamart_kepegawaian')->dropIfExists('tb_akun');
     }
}
