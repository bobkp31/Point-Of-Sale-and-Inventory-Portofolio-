<?php

namespace App\Http\Controllers\POS\Persedian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class TambahStokController extends Controller
{
    public function index()
    {
      return view('pos.pages.persedian.tambahStok.tambahStok');
    }

    public function daftarStok()
    {
      return view('pos.pages.persedian.tambahStok.daftarStok');
    }

    public function dataTablesStok()
    {
      $tb_stok = DB::table('tb_stok')
                     ->get();

      return Datatables::of($tb_stok)
                        //   ->addColumn('tambah',function($tb_stok){
                        //     return '<div class="row">
                        //               <div class="col-xs-2">
                        //                 <input type="text" style="width:50px" id="'.$tb_stok->id_stok.'">
                        //               </div>
                        //             </div>';
                        //   })
                        //  ->addColumn('pilihan',function($tb_stok){
                        //    return '<button  id="edit"
                        //                     class="btn
                        //                     btn-info btn-xs" type="button"
                        //                     name="button"
                        //                     data-toggle="modal"
                        //                     onclick="getStok('.$tb_stok->id_stok.','.$tb_stok->jumlah.')">
                        //                   Tambah
                        //             </button>';
                        //  })
                        //  ->rawColumns(['pilihan','tambah'])
                         ->make(true);
                        //->addColumn('pilihan','pos.pages.persedian.pilihan')
    }

    public function tambah(Request $request)
    {
      $id  = $request->id;
      $tambahan  = $request->tambah;
      $jumlah = $request->jumlah;

      // return $tambahan;
      $update = DB::table('tb_stok')
                    ->where('id_stok',$id)
                    ->update(['jumlah' => $jumlah + $tambahan]);

      //return "berhasil";
    }
}
