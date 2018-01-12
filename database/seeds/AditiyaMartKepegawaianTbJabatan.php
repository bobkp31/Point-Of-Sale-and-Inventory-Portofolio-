<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AditiyaMartKepegawaianTbJabatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('aditiyamart_kepegawaian')
           ->table('tb_jabatan')
           ->insert([
                    ['jabatan' => 'Owner'],
                    ['jabatan' => 'Manager'],
                    ['jabatan' => 'Asisten Manager'],
                    ['jabatan' => 'Kasir'],
                    ['jabatan' => 'Pramuniaga'],
                   ]);
    }
}
