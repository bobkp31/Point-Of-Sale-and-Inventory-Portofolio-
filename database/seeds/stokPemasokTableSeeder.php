<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class stokPemasokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tb_stok_pemasok')->insert([
        ['id_pemasok' => 'PMSK001', 'barcode' => '9311931024036'],
        ['id_pemasok' => 'PMSK001', 'barcode' => '8991002105485'],
        ['id_pemasok' => 'PMSK003', 'barcode' => '8991002104914'],
        ['id_pemasok' => 'PMSK003', 'barcode' => '089686010947']
      ]);
    }
}
