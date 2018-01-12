<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonPemasokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_pemasok', function (Blueprint $table) {
          $table->increments('id_diskon_pemasok');
          $table->string('id_pemasok','50');
          $table->double('nilai');

          $table->foreign('id_pemasok')
                ->references('id_pemasok')->on('tb_pemasok')
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
        Schema::dropIfExists('tb_diskon_pemasok');
    }
}
