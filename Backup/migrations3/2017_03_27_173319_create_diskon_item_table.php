<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiskonItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_diskon_item', function (Blueprint $table) {
            $table->integer('id_induk_diskon_item')->unsigned();
            $table->float('persentase');
            $table->double('nilai');

            //add constrain
            $table->primary('id_induk_diskon_item');
            $table->foreign('id_induk_diskon_item')
                  ->references('id_induk_diskon_item')
                  ->on('tb_induk_diskon_item')
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
        Schema::dropIfExists('tb_diskon_item');
    }
}
