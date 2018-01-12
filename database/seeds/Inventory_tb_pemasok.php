<?php

use Illuminate\Database\Seeder;

class Inventory_tb_pemasok extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('aditiyamart_inventory')
         ->table('tb_pemasok')
         ->insert([
                     ['nama_pemasok' => 'PT. Sejahtera',
                      'alamat' => 'Jl.sudirman',
                      'email' => 'sejahtera@gmail.com',
                      'no_telpon' => '0215484',
                      'no_handphone' => '085215479'
                     ],

                     ['nama_pemasok' => 'PT. Sentosa',
                      'alamat' => 'Jl.Saptamarga',
                      'email' => 'sentora@gmail.com',
                      'no_telpon' => '0215584',
                      'no_handphone' => '085215479'
                     ],

                     ['nama_pemasok' => 'PT. Selamat Selalu',
                      'alamat' => 'Jl.Tama sari',
                      'email' => 'selamat@gmail.com',
                      'no_telpon' => '0215584',
                      'no_handphone' => '085215479'
                     ],

                     ['nama_pemasok' => 'PT. Data Retail',
                      'alamat' => 'Jl.Tama sari no30',
                      'email' => 'retail@gmail.com',
                      'no_telpon' => '0215584',
                      'no_handphone' => '085215479'
                     ],
                  ]);
    }
}
