<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;


class InventoryArsipController extends Controller
{
     public function arsipIndex()
     {
         return view('inventory.arsip.arsip');
     }

     public function tampilTabelDaftarFaktur(Request $request)
     {
         return view('inventory.arsip.tabelDaftarFaktur');
     }

     public function tampilTabelDaftarFakturBulanan(Request $request)
     {
         return view('inventory.arsip.tabelDaftarFakturBulanan');
     }

     public function dataTabelsArsip($hari)
     {
         $faktur = DB::connection('aditiyamart_inventory')
                        ->table('tb_faktur')
                        ->whereDate('waktu_input','=',$hari)
                        ->where('status_input','=','berhasil')
                        ->get();

         return Datatables::of($faktur)
                             ->addColumn('pilihan',function($faktur){
                               return '<button  id="edit"
                                                class="btn
                                                btn-info btn-xs" type="button"
                                                name="button"
                                                data-toggle="modal"
                                                data-target="#modalEditBarang"
                                                onclick="lihatDetailFaktur('.$faktur->id.')">
                                              lihat
                                        </button>';
                               })
                            ->rawColumns(['pilihan'])
                            ->make(true);
     }

     public function dataTabelsArsipBulanan($bulan)
     {
      //  return $bulan;
       $faktur = DB::connection('aditiyamart_inventory')
                      ->table('tb_faktur')
                      ->whereRaw('date_format(waktu_input,"%Y-%m") = ?',[$bulan])
                      ->where('status_input','=','berhasil')
                      ->get();

      // return $faktur;
       return Datatables::of($faktur)
                      ->addColumn('pilihan',function($faktur){
                            return '<button  id="edit"
                                    class="btn
                                    btn-info btn-xs" type="button"
                                    name="button"
                                    data-toggle="modal"
                                    data-target="#modalEditBarang"
                                    onclick="lihatDetailFaktur('.$faktur->id.')">
                                    lihat
                                    </button>';
                                    })
                      ->rawColumns(['pilihan'])
                      ->make(true);
     }

     public function lihatDetailFaktur(Request $request)
     {
         $id = $request->id;
         $detailFaktur = DB::connection('aditiyamart_inventory')
                        ->table('tb_faktur')
                        ->join('tb_detail_faktur','tb_faktur.id','=','tb_detail_faktur.id_faktur')
                        ->join('tb_barcode','tb_detail_faktur.barcode','=','tb_barcode.barcode')
                        ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                        ->select('tb_barang.nama_barang','tb_faktur.*','tb_detail_faktur.barcode',
                                 'tb_detail_faktur.jumlah_barang','tb_detail_faktur.harga_satuan')
                        ->where('status_input','=','berhasil')
                        ->where('tb_faktur.id','=',$id)
                        ->get();

         return view('inventory.arsip.detailFaktur',['detailFaktur' => $detailFaktur]);
        //  return $detailFaktur;
     }
}
