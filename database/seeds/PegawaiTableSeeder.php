<?php

use Illuminate\Database\Seeder;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_pegawai')->insert([
          ['NIP'     => 'PG20170412001', 'nama_pegawai' => 'Hari Sutanto',
           'jabatan' => 'Manager', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170411009', 'nama_pegawai' => 'Agung Sutanto',
           'jabatan' => 'Asisten manager', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170411002', 'nama_pegawai' => 'Rima Melati',
           'jabatan' => 'Asisten manager', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412003', 'nama_pegawai' => 'Edi Sugoto',
           'jabatan' => 'Kepala toko', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412004', 'nama_pegawai' => 'Tata citata',
           'jabatan' => 'Kasir', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412005', 'nama_pegawai' => 'Zaskia Gothik',
           'jabatan' => 'Kasir', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412006', 'nama_pegawai' => 'Taufik Sugoto',
           'jabatan' => 'Pramuniaga', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412007', 'nama_pegawai' => 'Susilo',
           'jabatan' => 'Pramuniaga', 'status' => 'aktif' ],
          ['NIP'     => 'PG20170412008', 'nama_pegawai' => 'Joko',
           'jabatan' => 'Pramuniaga', 'status' => 'aktif' ]
        ]);
    }
}
