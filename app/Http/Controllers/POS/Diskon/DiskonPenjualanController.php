<?php

namespace App\Http\Controllers\POS\Diskon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DiskonPenjualanController extends Controller
{
  public function tabelDiskonPenjualan()
  {

    $tabelDiskonPenjualan = DB::table('tb_induk_diskon_penjualan')
                            ->join('tb_diskon_penjualan','tb_induk_diskon_penjualan.id_induk_diskon_penjualan','=','tb_diskon_penjualan.id_induk_diskon_penjualan')
                            // ->join('tb_diskon_item','id_induk_diskon_penjualan','=','tb_diskon_item.id_induk_diskon_penjualan')
                            ->whereRaw('tgl_berlaku <= now() AND tgl_berakhir >= now()')
                            ->get();

    return view('pos.pages.diskon.tambahDiskon.tabelDiskonPenjualan',['diskonPenjualans'=> $tabelDiskonPenjualan ]);
  }

  public function tambahDiskonPenjualan(Request $request)
  {
      $minimumPembelian = $request->minimumPembelian;
      $nilaiDiskon      = $request->nilaiDiskon;
      $nilai            = $request->nilai;
      $tanggalBerlaku   = $request->tanggalBerlaku;
      $tanggalBerakhir  = $request->tanggalBerakhir;
      $jamBerlaku       = $request->jamBerlaku;
      $jamBerakhir      = $request->jamBerakhir;

      if($nilaiDiskon == 'persentase'){
        $rupiah = 0;
        $persentase = $nilai;
      }else if($nilaiDiskon == 'rupiah'){
        $persentase = 0;
        $rupiah = $nilai;
      }
      // return $minimumPembelian.' '.$nilaiDiskon.' '.$nilai.
      //        ' '.$tanggalBerlaku.' '.$tanggalBerakhir.' '.$jamBerlaku.' '
      //        .$jamBerakhir;

      // 1. Insert ke tb_induk_diskon_penjualan
      $tambahDiskonInduk = DB::table('tb_induk_diskon_penjualan')
                                   ->insertGetId([
                                             'tgl_berlaku'  => $tanggalBerlaku.' '.$jamBerlaku,
                                             'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                           ]);
      // 2. id tb_induk_diskon_penjualan
      $idDiskonInduk = $tambahDiskonInduk;

      // 2. Insert ke tb_diskon_penjualan
      $tambahDiskonPenjualan = DB::table('tb_diskon_penjualan')
                                  ->insert([  'id_induk_diskon_penjualan' => $idDiskonInduk,
                                              'minimum_pembelian' => $minimumPembelian,
                                              'nilai_diskon' => $nilaiDiskon,
                                              'persentase' => $persentase,
                                              'rupiah'  => $rupiah
                                  ]);
      // 3. Insert tabel_diskon_log
     $tambahLogDiskon = DB::table('tb_diskon_log')
                            ->insert(['id_induk_diskon_penjualan' => $idDiskonInduk]);
    //  return $idDiskonPenjualan;
  }

  public function getIdDiskonPenjualan(Request $request)
  {
    $id = $request->id;

    $getDiskonPenjualan = DB::table('tb_induk_diskon_penjualan')
                            ->join('tb_diskon_penjualan','tb_induk_diskon_penjualan.id_induk_diskon_penjualan','=','tb_diskon_penjualan.id_induk_diskon_penjualan')
                            ->where('tb_induk_diskon_penjualan.id_induk_diskon_penjualan','=',$id)
                            ->get();
    return $getDiskonPenjualan;
  }

  public function editDiskonPenjualan(Request $request)
  {
    $id               = $request->id;
    $minimumPembelian = $request->minimumPembelian;
    $nilaiDiskon      = $request->nilaiDiskon;
    $nilai            = $request->nilai;
    $tanggalBerlaku   = $request->tanggalBerlaku;
    $tanggalBerakhir  = $request->tanggalBerakhir;
    $jamBerlaku       = $request->jamBerlaku;
    $jamBerakhir      = $request->jamBerakhir;

    if($nilaiDiskon == 'persentase'){
      $rupiah = 0;
      $persentase = $nilai;
    }else if($nilaiDiskon == 'rupiah'){
      $persentase = 0;
      $rupiah = $nilai;
    }

    // 1. Update ke tb_induk_diskon_penjualan
    $editDiskonInduk = DB::table('tb_induk_diskon_penjualan')
                                 ->where('id_induk_diskon_penjualan','=',$id)
                                 ->update([
                                           'tgl_berlaku'  => $tanggalBerlaku.' '.$jamBerlaku,
                                           'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                         ]);

    // 2. Update ke tb_diskon_item
    $editDiskonItem = DB::table('tb_diskon_penjualan')
                            ->where('id_induk_diskon_penjualan','=',$id)
                            ->update([ 'minimum_pembelian' => $minimumPembelian,
                                       'nilai_diskon'      => $nilaiDiskon,
                                       'persentase'        => $persentase,
                                       'rupiah'            => $rupiah
                                      ]);

  }
}
