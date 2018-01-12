<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
        //  $this->call(PemasokTableSeeder::class);
        //  $this->call(PegawaiTableSeeder::class);
        //  $this->call(stokPemasokTableSeeder::class);
         $this->call(StokTableSeeder::class);
         $this->call(AditiyaMartKepegawaianTbJabatan::class);
         $this->call(AditiyaMartKepegawaianTbPegawai::class);
         $this->call(AditiyaMartKepegawaianTbAkun::class);
         $this->call(Inventory_tb_kategori::class);
         $this->call(Inventory_tb_barang::class);
         $this->call(Inventory_tb_barcode::class);
         $this->call(Inventory_tb_pemasok::class);
    }
}
