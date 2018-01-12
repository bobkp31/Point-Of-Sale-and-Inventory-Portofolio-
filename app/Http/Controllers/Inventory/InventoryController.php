<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class InventoryController extends Controller
{
    public function showIndexFaktur()
    {

        $pemasok = DB::connection('aditiyamart_inventory')
                        ->table('tb_pemasok')
                        ->orderBy('nama_pemasok','asc')
                        ->get();
         return view('inventory.faktur.faktur',['pemasok'=>$pemasok]);
    }

    public function showIndexBarang()
    {
        $kategori = DB::connection('aditiyamart_inventory')
                        ->table('tb_kategori')
                        ->orderBy('kategori','asc')
                        ->get();

        $pemasok = DB::connection('aditiyamart_inventory')
                        ->table('tb_pemasok')
                        ->orderBy('nama_pemasok','asc')
                        ->get();

        return view('inventory.barang.barang',['kategori'=>$kategori,
                                               'pemasok'=>$pemasok]);
    }

    public function showIndexKirim()
    {
         return view('inventory.kirim.kirim');
    }
}
