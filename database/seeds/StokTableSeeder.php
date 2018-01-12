<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory;

class StokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Seeding using faker with qury builder
      // 1.create new faker
      // $faker = Factory::create();
      //
      // for ($i=0; $i < 10000 ; $i++) {
      //   # code...
      //   DB::table('tb_stok')->insert([
      //     'barcode' => $faker->isbn13, 'kd_barang' => $faker->isbn10,
      //     'nama_barang' => $faker->title, 'harga_jual' => $faker->randomNumber(6),
      //     'jumlah' => 0
      //   ]);
      // }







      // // seeding manual
      DB::table('tb_stok')->insert([
        ['barcode' => '9311931024036', 'kd_barang' => 'INDKFE001',
        'nama_barang' => 'Indocafe Coffeemix', 'harga_jual' => 2000,
        'hpp' => 1000,'stok_minimum' => 5,'jumlah' => 0],

        ['barcode' => '089686010947', 'kd_barang' => 'INDME001',
        'nama_barang' => 'Indomie Goreng', 'harga_jual' => 1500,
        'hpp' => 1000,'stok_minimum' => 5,'jumlah' => 0],

        ['barcode' => '8991002105485', 'kd_barang' => 'KPLAP001',
         'nama_barang' => 'Kapal Api Special Mix', 'harga_jual' => 2000,
         'hpp' => 1000,'stok_minimum' => 5,'jumlah' => 0],

        ['barcode' => '8991002104914', 'kd_barang' => 'KPLAP002',
         'nama_barang' => 'Kapal Api Mocha', 'harga_jual' => 2000,
         'hpp' => 1000,'stok_minimum' => 5,'jumlah' => 0]

      ]);

    }
}
