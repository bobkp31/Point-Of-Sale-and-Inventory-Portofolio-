<?php

use Illuminate\Database\Seeder;

class Inventory_tb_barang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('aditiyamart_inventory')
           ->table('tb_barang')
           ->insert([
                       ['kategori' => 'Telur',
                        'nama_barang' => 'TELUR ASIN', 'hpp' => '3000',
                        'harga_jual' => '3500',
                        'stok_tersedia' => 0 , 'stok_minimum' => 5],

                      ['kategori' => 'Obat Tradisional',
                       'nama_barang' => 'RIVANOL 100ML', 'hpp' => '2500',
                       'harga_jual' => '3000',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5],

                      ['kategori' => 'Minyak Angin/Urut',
                        'nama_barang' => 'SAFE CARE ARO.THERAPY', 'hpp' => '13600',
                        'harga_jual' => '15600',
                        'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Vitamin &Supplement',
                       'nama_barang' => 'VITACIMIN TAB 2 s', 'hpp' => '1260',
                       'harga_jual' => '1400',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Obat',
                       'nama_barang' => 'PEDITOX 50ML', 'hpp' => '5250',
                       'harga_jual' => '6300',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Obat',
                       'nama_barang' => 'ROHTO 7ML', 'hpp' => '9500',
                       'harga_jual' => '10900',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Shampoo',
                       'nama_barang' => 'SHAMPO METAL FORTIS 100ML ', 'hpp' => '15500',
                       'harga_jual' => '17400',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Craem & Jell',
                       'nama_barang' => 'ELLIPS VR HAIR TREATMEN 1ML', 'hpp' => '7000',
                       'harga_jual' => '7900',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Pewarna Rambut',
                       'nama_barang' => 'BIGEN POWDER BLACK', 'hpp' => '13000',
                       'harga_jual' => '14600',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5
                      ],

                      ['kategori' => 'Hair Kit',
                       'nama_barang' => 'EAGLE HENNA 6 S BROWN', 'hpp' => '4666',
                       'harga_jual' => '5300',
                       'stok_tersedia' => 0 , 'stok_minimum' => 5 ],

                    ]);
    }
}
