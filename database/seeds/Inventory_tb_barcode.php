<?php

use Illuminate\Database\Seeder;

class Inventory_tb_barcode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::connection('aditiyamart_inventory')
         ->table('tb_barcode')
         ->insert([
                     ['id_barang' => '1','barcode'     => '010822'],
                     ['id_barang' => '2','barcode'     => '001701'],
                     ['id_barang' => '3','barcode'     => '8995102800448'],
                     ['id_barang' => '4','barcode'     => '8991771200329'],
                     ['id_barang' => '5','barcode'     => '8993113021074'],
                     ['id_barang' => '6','barcode'     => '8992821100026'],
                     ['id_barang' => '7','barcode'     => '8995179500029'],
                     ['id_barang' => '8','barcode'     => '8993417200021'],
                     ['id_barang' => '9','barcode'     => '8992866110608'],
                     ['id_barang' => '10','barcode'     => '8694677100020'],
                  ]);
    }
}
