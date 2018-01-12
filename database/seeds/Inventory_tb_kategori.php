<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Inventory_tb_kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('aditiyamart_inventory')
           ->table('tb_kategori')
           ->insert([
                    ['kategori' => 'Telur'],
                    ['kategori' => 'Obat Tradisional'],
                    ['kategori' => 'Minyak Angin/Urut'],
                    ['kategori' => 'Vitamin &Supplement'],
                    ['kategori' => 'Obat'],
                    ['kategori' => 'Shampoo'],
                    ['kategori' => 'Craem & Jell'],
                    ['kategori' => 'Pewarna Rambut'],
                    ['kategori' => 'Hair Kit'],
                    ['kategori' => 'Kosmetik Wajah'],
                    ['kategori' => 'Kosmetik Kuku'],
                    ['kategori' => 'Kosmetik Mata'],
                    ['kategori' => 'Kosmetik Bibir'],
                    ['kategori' => 'Beauty Kit'],
                    ['kategori' => 'Body Cologne'],
                    ['kategori' => 'Sabun Perawatan'],
                    ['kategori' => 'Bedak/Talek'],
                    ]);
    }
}
