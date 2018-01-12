<?php

use Illuminate\Database\Seeder;

class AditiyaMartKepegawaianTbPegawai extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('aditiyamart_kepegawaian')
           ->table('tb_pegawai')
           ->insert([
                    ['nip' => 'PG001','nama' => 'Rudi kurnia',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 2,
                     'tgl_lahir' => '1993-05-12'],

                    ['nip' => 'PG002','nama' => 'Aryan Ronal',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 1,
                     'tgl_lahir' => '1978-05-12'],

                    ['nip' => 'PG003','nama' => 'Lisa Aryanti',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 3,
                     'tgl_lahir' => '1990-05-12'],

                    ['nip' => 'PG004','nama' => 'Nurdin',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 4,
                     'tgl_lahir' => '1993-05-12'],

                    ['nip' => 'PG005','nama' => 'Lukman Ginanjar',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 5,
                     'tgl_lahir' => '1993-05-12'],

                    ['nip' => 'PG006','nama' => 'Tinatalisa',
                     'alamat' => 'Jl.Galau', 'id_jabatan' => 4,
                     'tgl_lahir' => '1993-05-12'],

                    ]);
    }
}
