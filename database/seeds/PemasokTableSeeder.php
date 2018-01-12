<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PemasokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tb_pemasok')->insert([
        ['id_pemasok' => 'PMSK001', 'nama_pemasok' => 'PT.Belum Tau'],
        ['id_pemasok' => 'PMSK002', 'nama_pemasok' => 'PT.Sinar Jaya'],
        ['id_pemasok' => 'PMSK003', 'nama_pemasok' => 'PT.Sinar Harapan'],
        ['id_pemasok' => 'PMSK004', 'nama_pemasok' => 'PT.Kino Keno'],
        ['id_pemasok' => 'PMSK005', 'nama_pemasok' => 'PT.Echo eth0']
      ]);
    }
}
