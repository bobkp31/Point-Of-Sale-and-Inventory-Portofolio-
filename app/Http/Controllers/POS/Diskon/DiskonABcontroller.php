<?php

namespace App\Http\Controllers\POS\Diskon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DiskonABcontroller extends Controller
{
  public function tabelDiskonAB()
  {
    return view('pos.pages.diskon.tambahDiskon.tabelDiskonAB');
  }

  public function tambahDiskonAB(Request $request)
  {
      $barcodeA = $request->barcodeA;
      $barcodeB = $request->barcodeB;
      $namaBarangB = $request->namaBarangB;
      $qtyPembelian = $request->qtyPembelian;
      $qtyBonus = $request->qtyBonus;
      $tanggalBerlaku = $request->tanggalBerlaku;
      $tanggalBerakhir = $request->tanggalBerakhir;
      $jamBerlaku = $request->jamBerlaku;
      $jamBerakhir = $request->jamBerakhir;
      $kelipatan = $request->kelipatan;

      // return $barcodeA.' '.$barcodeB.' '.$qtyPembelian.' '.$qtyBonus.' '.$tanggalBerlaku.' '.$tanggalBerakhir.' '.$jamBerlaku.' '.$jamBerakhir.' '.$kelipatan;

      // 1. Tambah tabel tb_induk_diskon_item
      $tambahTabelInduk = DB::table('tb_induk_diskon_item')
                             ->insertGetId(['barcode' => $barcodeA,
                                       'tgl_berlaku' => $tanggalBerlaku.' '.$jamBerlaku,
                                       'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                     ]);
      // 2. Ambil Id tb_induk_diskon_item
      $idIndukDiskon = $tambahTabelInduk;

      // 3. Tambah tabel Diskon Ab
      $tabelDiskonAB = DB::table('tb_diskon_AB')
                             ->insert(['id_induk_diskon_item' => $idIndukDiskon,
                                       'barcode_B' => $barcodeB,
                                       'nama_barang_diskon' => $namaBarangB,
                                       'qty_pembelian' =>$qtyPembelian,
                                       'qty_bonus' => $qtyBonus,
                                       'berlaku_kelipatan' => $kelipatan
                                     ]);
      // 4. Tambah diskon log
      $diskonLog = DB::table('tb_diskon_log')
                      ->insert(['id_induk_diskon_item' => $idIndukDiskon]);

  }

  public function dataTablesDiskonAB()
  {
    $tabelDiskonAB  = DB::table('tb_diskon_AB')
                        ->join('tb_induk_diskon_item','tb_diskon_AB.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                        ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                        ->whereRaw('tgl_berlaku <= now() AND tgl_berakhir >= now()')
                        ->get();

    return Datatables::of($tabelDiskonAB)
                      ->addColumn('pilihan',function($tabelDiskonAB){
                        return '<button  id="edit"
                                         class="btn
                                         btn-info btn-xs" type="button"
                                         name="button"
                                         data-toggle="modal"
                                         data-target="#modalEditDiskonAB"
                                         onclick="getIdDiskonAB('.$tabelDiskonAB->id_induk_diskon_item.')">
                                       edit
                                 </button>';
                      })
                      ->rawColumns(['pilihan'])
                      ->make(true);

  }

  public function getIdDiskonAB(Request $request)
  {
      $id = $request->id;

      $tabelDiskonAB  = DB::table('tb_diskon_AB')
                          ->join('tb_induk_diskon_item','tb_diskon_AB.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                          ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                          ->where('tb_diskon_AB.id_induk_diskon_item','=',$id)
                          ->get();

      return $tabelDiskonAB;
  }

  public function editDiskonAB(Request $request)
  {
    $id = $request->id;
    $qtyPembelian = $request->qtyPembelian;
    $qtyBonus = $request->qtyBonus;
    $tanggalBerlaku = $request->tanggalBerlaku;
    $tanggalBerakhir = $request->tanggalBerakhir;
    $jamBerlaku = $request->jamBerlaku;
    $jamBerakhir = $request->jamBerakhir;
    $kelipatan = $request->kelipatan;

    // 1. Edit tabel tb_induk_diskon_item
    $tambahTabelInduk = DB::table('tb_induk_diskon_item')
                           ->where('id_induk_diskon_item','=',$id)
                           ->update([
                                     'tgl_berlaku' => $tanggalBerlaku.' '.$jamBerlaku,
                                     'tgl_berakhir' => $tanggalBerakhir.' '.$jamBerakhir
                                   ]);
    // 2. Edit Tabel tb_diskon_AB
    $tabelDiskonAB = DB::table('tb_diskon_AB')
                           ->where('id_induk_diskon_item','=',$id)
                           ->update(['id_induk_diskon_item' => $id,
                                     'qty_pembelian' =>$qtyPembelian,
                                     'qty_bonus' => $qtyBonus,
                                     'berlaku_kelipatan' => $kelipatan
                                   ]);

  }
}
