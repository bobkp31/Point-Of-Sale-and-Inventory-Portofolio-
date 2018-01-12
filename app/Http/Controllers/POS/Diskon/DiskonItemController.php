<?php

namespace App\Http\Controllers\POS\Diskon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DiskonItemController extends Controller
{


    public function tambahDiskonItem(Request $request)
    {
      $barcode  = $request->barcode;
      $namaBarang    = $request->namaBarang;
      $hargaJual    = $request->hargaJual;
      $jenisNilai  = $request->jenisNilai;
      $nilaiDiskon = $request->nilaiDiskon;
      $hargaSetelahDiskon = $request->hargaSetelahDiskon;
      $tanggalMulai = $request->tanggalMulai;
      $tanggalBerakhir = $request->tanggalBerakhir;
      $jamMulai    = $request->jamMulai;
      $jamBerakhir = $request->jamBerakhir;

      if($jenisNilai == 'persentase'){
        $persentase = $nilaiDiskon;
        $nilai = $hargaJual * ($persentase/100);
      }else if ($jenisNilai == 'rupiah'){
        $nilai = $nilaiDiskon;
        $persentase = (100/$hargaJual) * $nilai;
      }

      // return $persentase.' '.$nilai;
      // return ($barcode.' '.$namaBarang.' '.$hargaJual.' '.$jenisNilai.' '.$nilaiDiskon.' '.$hargaSetelahDiskon.' '.$tanggalMulai.' '.$tanggalBerakhir);

      // 1. insert ke tabel tb_induk_diskon_item
      $tb_induk_diskon_item = DB::table('tb_induk_diskon_item')
                      ->insertGetId(['barcode' => $barcode,
                                     'tgl_berlaku' => $tanggalMulai.' '.$jamMulai,
                                     'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                    ]);

      // 2. ambil id diskon tb_induk_diskon_item
      $idIndukDiskonItem = $tb_induk_diskon_item;

      // 3. insert ke tabel tb_diskon_log
      $tb_log_diskon = DB::table('tb_diskon_log')
                        ->insert(['id_induk_diskon_item'  => $idIndukDiskonItem]);

      // 4. insert ke tabel tb_diskon_item
      $tb_diskon_item = DB::table('tb_diskon_item')
                      ->insertGetId(['id_induk_diskon_item'  => $idIndukDiskonItem,
                                     'persentase'   => $persentase,
                                     'nilai'   => $nilai
                                    ]);
    }


    public function dataTablesDiskonItem()
    {
      $diskon  = DB::table('tb_induk_diskon_item')
                    ->join('tb_diskon_item','tb_induk_diskon_item.id_induk_diskon_item','=','tb_diskon_item.id_induk_diskon_item')
                    ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                    ->whereRaw('tgl_berlaku <= now() AND tgl_berakhir >= now()')
                    ->get();


      return Datatables::of($diskon)
                        ->addColumn('pilihan',function($diskon){
                          return '<button  id="edit"
                                           class="btn
                                           btn-info btn-xs" type="button"
                                           name="button"
                                           data-toggle="modal"
                                           data-target="#modalEditDiskonItem"
                                           onclick="get_diskonItem('.$diskon->id_induk_diskon_item.')">
                                         edit
                                   </button>';
                        })
                        ->rawColumns(['pilihan'])
                        ->make(true);
    }

    public function editDiskonItem(Request $request)
    {
      $id = $request->id;
      $hargaJual    = $request->hargaJual;
      $jenisNilai  = $request->jenisNilai;
      $nilaiDiskon = $request->nilaiDiskon;
      $hargaSetelahDiskon = $request->hargaSetelahDiskon;

      $tanggalBerlaku = $request->tanggalBerlaku;
      $tanggalBerakhir = $request->tanggalBerakhir;
      $jamBerlaku    = $request->jamBerlaku;
      $jamBerakhir = $request->jamBerakhir;

      if($jenisNilai == 'persentase'){
        $persentase = $nilaiDiskon;
        $nilai = $hargaJual * ($persentase/100);
      }else if ($jenisNilai == 'rupiah'){
        $nilai = $nilaiDiskon;
        $persentase = (100/$hargaJual) * $nilai;
      }

      //1. Update tabel tb_induk_diskon_item
      $update_tb_induk = DB::table('tb_induk_diskon_item')
                   ->where('id_induk_diskon_item','=',$id)
                   ->update(['tgl_berlaku' => $tanggalBerlaku.' '.$jamBerlaku,
                             'tgl_berakhir'=> $tanggalBerakhir.' '.$jamBerakhir]);

      //2. Update tabel tb_diskon_item
      $update_tb_diskon_item = DB::table('tb_diskon_item')
                                 ->where('id_induk_diskon_item','=',$id)
                                 ->update(['persentase' => $persentase,
                                           'nilai'      => $nilai]);

      //return $persentase.' '.$nilai;
      //return ($id.' '.$hargaJual.' '.$jenisNilai.' '.$nilaiDiskon.' '.$hargaSetelahDiskon.' '.$tanggalBerlaku.' '.$tanggalBerakhir);

    }

    public function tabelDiskonItem()
    {
      return view('pos.pages.diskon.tambahDiskon.tabelDiskonItem');
    }

    public function getDiskonItem(Request $request)
    {
      $id = $request->id;

      $tb_diskon_item  = DB::table('tb_induk_diskon_item')
                      ->join('tb_diskon_item','tb_induk_diskon_item.id_induk_diskon_item','=','tb_diskon_item.id_induk_diskon_item')
                      ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                      ->where('tb_induk_diskon_item.id_induk_diskon_item','=',$id)
                      ->get();

       //
      return $tb_diskon_item;

    }
}
