<?php

namespace App\Http\Controllers\POS\Persedian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class TambahProdukController extends Controller
{
    public function index()
    {
      $tb_pemasok = DB::table('tb_pemasok')
      ->select('id_pemasok','nama_pemasok')
      ->get();

      return view('pos.pages.persedian.tambahProduk.tambahProduk',['pemasoks' => $tb_pemasok]);
    }

    public function daftarProduk()
    {
      return view('pos.pages.persedian.tambahProduk.daftarProduk');
    }

    public function dataTablesProduk()
    {
      $tb_stok = DB::table('tb_stok')
                     ->where('status','=','Aktif')
                     ->get();
      return Datatables::of($tb_stok)
                          ->addColumn('hapus',function($tb_stok){
                            return '<button  id="edit"
                            class="btn btn-info btn-xs" type="button"
                            name="button"
                            data-toggle="modal"
                            onclick="hapusProduk('.$tb_stok->id_stok.')">
                            hapus
                            </button>';
                          })
                         ->addColumn('pilihan',function($tb_stok){
                           return '<button  id="edit"
                                            class="btn
                                            btn-info btn-xs" type="button"
                                            name="button"
                                            data-toggle="modal"
                                            data-target="#modalEditProduk"
                                            onclick="get_barcode('.$tb_stok->id_stok.')">
                                          edit
                                    </button>';
                         })
                         ->rawColumns(['pilihan','hapus'])
                         ->make(true);
                        //->addColumn('pilihan','pos.pages.persedian.pilihan')
    }

    public function getBarcode(Request $request)
    {
      if($request->ajax()){
            $id = $request->id;
            $tb_stok = DB::table('tb_stok')
                           ->where('id_stok','=',$id)
                           ->get();

            return response()->json($tb_stok);
          }
     }

     public function editProduk(Request $request)
      {
         if($request->ajax()){
           $idStok  = $request->idStok;
           $barcode = $request->barcode;
           $hpp = $request->hpp;
           $namaBarang = $request->namaBarang;
           $hargaJual = $request->hargaJual;
           $jumlah = $request->jumlah;

          // return($idStok.' '.$barcode.' '.$kdBarang.' '.$namaBarang.' '.$hargaJual.' '.$jumlah);
           $updateBarang = DB::table('tb_stok')
                               ->where('id_stok',$idStok)
                               ->update(['nama_barang'  => $namaBarang,
                                         'hpp'          => $hpp,
                                         'harga_jual'   => $hargaJual,
                                         'jumlah'       => $jumlah
                                       ]);
           return 'berhasil';

         }
      }

      public function tambahProduk(Request $request)
      {
         if($request->ajax()){
           $barcode = $request->barcode;
           $hpp = $request->hpp;
           $namaBarang = $request->namaBarang;
           $hargaJual = $request->hargaJual;

          //return $barcode.' '.$kdBarang.' '.$namaBarang.' '.$hargaJual.' '.$pemasok;

           $tambahBarang = DB::table('tb_stok')
                               ->insert([
                                 'barcode'       => $barcode,
                                 'nama_barang'   => $namaBarang,
                                 'hpp'           => $hpp,
                                 'harga_jual'    => $hargaJual,
                                 'jumlah'        => 0
                               ]);

           return 'berhasil';

         }
      }

      public function hapusProduk(Request $request)
      {
          $idStok = $request->id;

          $hapus = DB::table('tb_stok')
                       ->where('id_stok',$idStok)
                       ->update(['status' => 'Di Hapus']);

          return 'sukses';
      }

}
