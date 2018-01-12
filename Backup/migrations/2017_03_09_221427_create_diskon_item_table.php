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
            $table->increments('id_diskon_item');
            $table->string('barcode','50');
            $table->double('nilai');
            $table->double('total');

            //add constrain
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
        Schema::dropIfExists('tb_diskon_item');
    }
}
