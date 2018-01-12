<?php

namespace App\Http\Controllers\POS\Persedian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;


class TambahPemasokController extends Controller
{
    public function index()
    {
      return view('pos.pages.persedian.tambahPemasok.tambahPemasok');
    }

    public function daftarPemasok()
    {
      return view('pos.pages.persedian.tambahPemasok.daftarPemasok');
    }

    public function dataTablesPemasok()
    {
      $tb_pemasok = DB::table('tb_pemasok')
                     ->where('status','=','Aktif')
                     ->get();

      return Datatables::of($tb_pemasok)
                          ->addColumn('hapus',function($tb_pemasok){
                            return '<button  id="edit"
                            class="btn btn-info btn-xs" type="button"
                            name="button"
                            data-toggle="modal"
                            onclick="hapusProduk('.$tb_pemasok->id_pemasok.')">
                            hapus
                            </button>';
                          })
                         ->addColumn('pilihan',function($tb_pemasok){
                           return '<button  id="edit"
                                            class="btn
                                            btn-info btn-xs" type="button"
                                            name="button"
                                            data-toggle="modal"
                                            data-target="#modalEditPemasok"
                                            onclick="get_id('.$tb_pemasok->id_pemasok.')">
                                          edit
                                    </button>';
                         })
                         ->rawColumns(['pilihan','hapus'])
                         ->make(true);
                        //->addColumn('pilihan','pos.pages.persedian.pilihan')
    }
}
