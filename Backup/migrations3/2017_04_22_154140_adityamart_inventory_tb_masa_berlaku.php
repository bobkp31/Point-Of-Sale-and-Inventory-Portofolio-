<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdityamartInventoryTbMasaBerlaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_masa_berlaku', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('masa_berlaku');
            $table->sting('no_faktur');
            $table->sting('id_pemasok');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::connection('aditiyamart_inventory')->dropIfExists('tb_masa_berlaku');
    }
}
