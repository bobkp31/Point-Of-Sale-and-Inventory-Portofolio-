<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AditiyamartInventoryTbPemasok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('aditiyamart_inventory')
            ->create('tb_pemasok', function (Blueprint $table) {
            $table->string('nama_pemasok','150');
            $table->string('alamat','150');
            $table->string('kota','150')->nullable();
            $table->string('email','150')->nullable();
            $table->string('no_telpon','150')->nullable();
            $table->string('no_handphone','150')->nullable();

            $table->primary('nama_pemasok');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('aditiyamart_inventory')->dropIfExists('tb_pemasok');
    }
}
