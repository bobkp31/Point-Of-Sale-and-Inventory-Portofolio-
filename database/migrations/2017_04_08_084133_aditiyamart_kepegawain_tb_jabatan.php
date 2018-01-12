<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartKepegawainTbJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_kepegawaian')
              ->create('tb_jabatan', function (Blueprint $table) {
                  $table->increments('id');
                  $table->string('jabatan','150');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('aditiyamart_kepegawaian')->dropIfExists('tb_jabatan');
    }
}
