<?php

use Illuminate\Database\Seeder;

class AditiyaMartKepegawaianTbAkun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('aditiyamart_kepegawaian')
         ->table('tb_akun')
         ->insert([
                  ['nip' => 'PG002','username' => 'owner',
                   'password' => '12345', 'hak_akses' => 'Owner'],

                  ['nip' => 'PG001','username' => 'manager',
                   'password' => '12345', 'hak_akses' => 'Manager'],

                  ['nip' => 'PG006','username' => 'kasir',
                   'password' => '12345', 'hak_akses' => 'Kasir'],

                  ['nip' => 'PG003','username' => 'asistenManager',
                   'password' => '12345', 'hak_akses' => 'Asisten Manager'],

                  ]);
    }
}
