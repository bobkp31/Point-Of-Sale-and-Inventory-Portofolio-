<?php

namespace App\Http\Controllers\POS\Diskon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class TambahDiskonController extends Controller
{
    public function index()
    {

       return view('pos.pages.diskon.tambahDiskon.tampilTambahDiskon');
    }

    public function formDiskonPenjualan()
    {
       return view('pos.pages.diskon.tambahDiskon.formDiskonPenjualan');
    }

    public function formDiskonItem()
    {
      return view('pos.pages.diskon.tambahDiskon.formDiskonItem');
    }

    public function formDiskonAB()
    {
      return view('pos.pages.diskon.tambahDiskon.formDiskonAB');
    }

    public function formDiskonJumlahMinimalN()
    {
      // return 'hello';
      return view('pos.pages.diskon.tambahDiskon.formJumlahMinimalN');
    }




    public function cariBarcode(Request $request)
    {
        $barcode = $request->barcode;
        $cari = DB::table('tb_stok')
                    ->where('barcode',$barcode)
                    ->get();

        return response()->json($cari);


    }
}
