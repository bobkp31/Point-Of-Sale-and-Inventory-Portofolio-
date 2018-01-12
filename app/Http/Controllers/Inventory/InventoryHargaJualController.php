<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryHargaJualController extends Controller
{
    public function index()
    {
        return view('inventory.hargaJual.hargaJual');
    }

    public function cariBarang(Request $request)
    {
        $barcode = $request->barcode;
        if(empty($barcode)){
          return 'kosong';
        }else{
          $cariBarang = DB::connection('aditiyamart_inventory')
                        ->table('tb_barang')
                        ->join('tb_barcode','tb_barang.id','=','tb_barcode.id_barang')
                        ->where('barcode','=',$barcode)
                        ->first();

          return view('inventory.hargaJual.formHargaJual',['barang' => $cariBarang]);
        }
    }


    public function ubahHargaJual(Request $request)
    {
        $hargaJual = $request->hargaJual;
        $barcode = $request->barcode;

        #ubah harga jual
        $ubahHargaJual = DB::connection('aditiyamart_inventory')
                              ->table('tb_barang')
                              ->join('tb_barcode','tb_barang.id','=','tb_barcode.id_barang')
                              ->where('barcode','=',$barcode)
                              ->update(['harga_jual' => $hargaJual]);
        return $hargaJual;
    }
}
