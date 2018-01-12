<?php

namespace App\Http\Controllers\POS\Diskon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DiskonJumlahMinimalNController extends Controller
{
    public function tabelJumlahMinimalN()
    {
        return view('pos.pages.diskon.tambahDiskon.tabelJumlahMinimalN');
    }

    public function tambahDiskonMinimalN(Request $request)
    {
      $barcode = $request->barcode;
      $namaBarang = $request->namaBarang;
      $hargaJual = $request->hargaJual;
      $qtyPembelian = $request->qtyPembelian;
      $jenisNilai = $request->jenisNilai;
      $nilaiDiskon = $request->nilaiDiskon;
      $tanggalBerlaku = $request->tanggalBerlaku;
      $tanggalBerakhir = $request->tanggalBerakhir;
      $jamBerlaku = $request->jamBerlaku;
      $jamBerakhir = $request->jamBerakhir;

      if($jenisNilai == 'persentase'){
        $persentase = $nilaiDiskon;
        $nilai = $hargaJual * ($persentase/100);
      }else if ($jenisNilai == 'rupiah'){
        $nilai = $nilaiDiskon;
        $persentase = (100/$hargaJual) * $nilai;
      }

      // return ($barcode.' '.$namaBarang.' '.$hargaJual.' '.$jenisNilai.' '.$nilaiDiskon.' '.$tanggalBerlaku.' '.$tanggalBerakhir.' '.
              // $jamBerlaku.' '.$tanggalBerlaku.' '.$persentase.' '.$nilai);

      // 1. insert ke tabel tb_induk_diskon_item
      $tb_induk_diskon_item = DB::table('tb_induk_diskon_item')
                              ->insertGetId(['barcode' => $barcode,
                                             'tgl_berlaku' => $tanggalBerlaku.' '.$jamBerlaku,
                                             'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                            ]);
      // 2. ambil id diskon tb_induk_diskon_item
      $idIndukDiskonItem = $tb_induk_diskon_item;

      // 3. insert ke tabel tb_diskon_log
      $tb_log_diskon = DB::table('tb_diskon_log')
                        ->insert(['id_induk_diskon_item'  => $idIndukDiskonItem]);

      // 4. insert ke tabel tb_diskon_item
      $tb_diskon_item = DB::table('tb_diskon_minimum_item')
                      ->insertGetId(['id_induk_diskon_item'  => $idIndukDiskonItem,
                                     'qty_pembelian' => $qtyPembelian,
                                     'persentase'   => $persentase,
                                     'nilai'   => $nilai,
                                    ]);

    }

    public function dataTablesDiskonMinimalN()
    {

      $diskon  = DB::table('tb_diskon_minimum_item')
                    ->join('tb_induk_diskon_item','tb_diskon_minimum_item.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                    ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                    ->whereRaw('tgl_berlaku <= now() AND tgl_berakhir >= now()')
                    //  ->where([['tb_induk_diskon_item.tgl_berlaku','>=','date_format(now(),%r)'],
                    //           ['tb_induk_diskon_item.tgl_berakhir','<=',$dateBerakhir]])
                    ->get();


      return Datatables::of($diskon)
                        ->addColumn('pilihan',function($diskon){
                          return '<button  id="edit"
                                           class="btn
                                           btn-info btn-xs" type="button"
                                           name="button"
                                           data-toggle="modal"
                                           data-target="#modalEditDiskonMinimumN"
                                           onclick="getIdDiskonMinimumN('.$diskon->id_induk_diskon_item.')">
                                         edit
                                   </button>';
                        })
                        ->rawColumns(['pilihan'])
                        ->make(true);
    }

    public function getIdDiskonMinimumN(Request $request)
    {
      $id = $request->id;
      $diskon = DB::table('tb_diskon_minimum_item')
                    ->join('tb_induk_diskon_item','tb_diskon_minimum_item.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                    ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                    ->where('tb_diskon_minimum_item.id_induk_diskon_item','=',$id)
                    ->get();

      return $diskon;
    }

    public function editDiskonMinimumN(Request $request)
    {
      $id = $request->id;
      $namaBarang = $request->namaBarang;
      $hargaJual    = $request->hargaJual;
      $jenisNilai  = $request->jenisNilai;
      $qtyPembelian = $request->qtyPembelian;
      $kelipatan = $request->kelipatan;
      $nilaiDiskon = $request->nilaiDiskon;
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
      // return $id.' '.$namaBarang.' '.$hargaJual.' '.$jenisNilai.' '.
      //       $qtyPembelian.' '.$kelipatan.' '.$nilaiDiskon.' '.
      //       $tanggalBerlaku.' '.$tanggalBerakhir.' '.$jamBerlaku.' '.
      //       $jamBerakhir.' '.$persentase.' '.$nilai;
      //        $jamBerlaku.' '.$tanggalBerlaku.' '.$persentase.' '.$nilai.' '.$qty_pembelian.' '.$kelipatan;

             //1. Update tabel tb_induk_diskon_item
             $update_tb_induk = DB::table('tb_induk_diskon_item')
                          ->where('id_induk_diskon_item','=',$id)
                          ->update(['tgl_berlaku' => $tanggalBerlaku.' '.$jamBerlaku,
                                    'tgl_berakhir'=> $tanggalBerakhir.' '.$jamBerakhir]);

             //2. Update tabel tb_diskon_item
             $update_tb_diskon_item = DB::table('tb_diskon_minimum_item')
                          ->where('id_induk_diskon_item','=',$id)
                          ->update(['persentase' => $persentase,
                                    'nilai'      => $nilai,
                                    'qty_pembelian' => $qtyPembelian,
                                    'berlaku_kelipatan' => $kelipatan
                                    ]);

    }
}
