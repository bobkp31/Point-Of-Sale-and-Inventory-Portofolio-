<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryKirimController extends Controller
{
    public function formKirim()
    {

        $detailPengiriman = DB::connection('aditiyamart_inventory')
                                  ->table('tb_detail_kirim_barang')
                                  ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                  ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                                  ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                                  ->select('tb_barang.nama_barang','tb_detail_kirim_barang.*')
                                  ->where('status_pengiriman','=','proses')
                                  ->get();

        return view('inventory.kirim.formKirim',['detailBarang' => $detailPengiriman ]);
    }


    public function cariBarang(Request $request)
      {
          $barcode = $request->barcode;
          $cariBarcode = DB::connection('aditiyamart_inventory')
                             ->table('tb_barcode')
                             ->join('tb_barang','tb_barang.id','=','tb_barcode.id_barang')
                             ->where('tb_barcode.barcode','=',$barcode)
                             ->get();

          return $cariBarcode;
    }


    public function tambahBarangKirim(Request $request)
      {
          $sekarang = date('Y-m-d H:i:s');
          $barcode = $request->barcode;
          $jumlah  = $request->jumlah;
          $toko    = $request->toko;

          #Cek Tabel Kirim Barang
          $cekTabelKirimbarang = DB::connection('aditiyamart_inventory')
                                    ->table('tb_kirim_barang')
                                    ->where('status_pengiriman','=','proses')
                                    ->get();

          #Jika ada Status Proses
          if(count($cekTabelKirimbarang) < 1){
             #tambah tabel tb_detail_pengiriman
             $tbPengirimanBarang = DB::connection('aditiyamart_inventory')
                                       ->table('tb_kirim_barang')
                                       ->insertGetId(['waktu' => $sekarang,
                                                 'nip' => session('nip'),
                                                 'nama_toko' => $toko,
                                                 'status_pengiriman' => 'proses'
                                               ]);
             #Tambah Tabel tb_kirim barang
             $tbdetailKirimBarang = DB::connection('aditiyamart_inventory')
                                       ->table('tb_detail_kirim_barang')
                                       ->insert(['barcode' => $barcode,
                                                 'id_kirim_barang' => $tbPengirimanBarang,
                                                 'jumlah' => $jumlah
                                               ]);

          #Jika tidak ada status Proses
          }else if(count($cekTabelKirimbarang) > 0){
             #cek Dupkikat yg akan di tambahakn
             $cekDuplikat = DB::connection('aditiyamart_inventory')
                                ->table('tb_detail_kirim_barang')
                                ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                ->where('barcode','=',$barcode)
                                ->where('status_pengiriman','=','proses')
                                ->get();
             //return count($cekDuplikat);

             if(count($cekDuplikat) < 1){
               $tbdetailKirimBarang = DB::connection('aditiyamart_inventory')
                                          ->table('tb_detail_kirim_barang')
                                          ->insert(['barcode' => $barcode,
                                                    'id_kirim_barang' => $cekTabelKirimbarang[0]->id,
                                                    'jumlah' => $jumlah
                                                  ]);
             }else if(count($cekTabelKirimbarang) > 0){
               return 'sudah ada';
             }
          }



    }

  public function getBarcode(Request $request)
  {
      $id = $request->id;
      $tbDetailBarang = DB::connection('aditiyamart_inventory')
                          ->table('tb_detail_kirim_barang')
                          ->where('id','=',$id)
                          ->get();

      return $tbDetailBarang;
  }

  public function editDetailPegiriman(Request $request)
  {
      $id     = $request->id;
      $jumlah = $request->jumlah;

      $editPengiriman = DB::connection('aditiyamart_inventory')
                          ->table('tb_detail_kirim_barang')
                          ->where('id','=',$id)
                          ->update(['jumlah' => $jumlah]);

      return $id;
  }

  public function kartuStok()
  {
      $nomorPegiriman = DB::connection('aditiyamart_inventory')
                            ->table('tb_kirim_barang')
                            ->where('status_pengiriman','=','proses')
                            ->first();

      $tbKirimBarang = DB::connection('aditiyamart_inventory')
                           ->table('tb_kirim_barang')
                           ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                           ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                           ->join('tb_barang','tb_barcode.id_barang','tb_barang.id')
                           ->where('status_pengiriman','=','proses')
                           ->get();
      // return $tbKirimBarang;
      return view('inventory.kirim.kartuStok',['detail' => $tbKirimBarang,
                                               'noPengiriman' => $nomorPegiriman]);
  }

  public function kirimBarang(Request $request)
  {
      $noPengiriman = $request->noPengiriman;

      #cek barang di stok toko
        #Ambil barcode dari pengiriman barang
        $ambilBarcode = DB::connection('aditiyamart_inventory')
                            ->table('tb_kirim_barang')
                            ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                            ->where('tb_kirim_barang.id','=',$noPengiriman)
                            ->get();

        $jumlahPengecekan = count($ambilBarcode);

        #cek barang
        for ($i=0; $i < $jumlahPengecekan; $i++) {
           #cek barang di toko
           $cek = DB::table('tb_stok')
                      ->where('barcode','=',$ambilBarcode[$i]->barcode)
                      ->get();

           #barang Tidak Ada
           if(count($cek) < 1){
             #Ambil detail barang di tabel tb_barang gudang
             $detailBarang = DB::connection('aditiyamart_inventory')
                                    ->table('tb_barang')
                                    ->join('tb_barcode','tb_barang.id','=','tb_barcode.id_barang')
                                    ->where('barcode','=',$ambilBarcode[$i]->barcode)
                                    ->get();

             #Tambah Barang ke stok toko
             $tambahBarangToko = DB::table('tb_stok')
                                    ->insert(['barcode' => $detailBarang[0]->barcode,
                                              'kd_barang' => $detailBarang[0]->id,
                                              'nama_barang' => $detailBarang[0]->nama_barang,
                                              'hpp' =>  $detailBarang[0]->hpp,
                                              'harga_jual' => $detailBarang[0]->harga_jual,
                                              'jumlah' => $ambilBarcode[$i]->jumlah,
                                              'stok_minimum' => 5,
                                              'status' => 'Aktif'
                                            ]);
             #Tambah Stok Toko (udah di tambah waktu insert hahahahahaahah)

             #Ambil stok gudang
             $stokGudang = $detailBarang[0]->stok_tersedia;

             #Kurangi Stok Gudang
             $kurangiStokGudang = DB::connection('aditiyamart_inventory')
                                 ->table('tb_barang')
                                 ->join('tb_barcode','tb_barang.id','tb_barcode.id_barang')
                                 ->where('barcode','=',$ambilBarcode[$i]->barcode)
                                 ->update(['stok_tersedia' => $stokGudang - $ambilBarcode[$i]->jumlah]);

              #Update Status Barang yang di kirim
              $statusPengiriman = DB::connection('aditiyamart_inventory')
                                  ->table('tb_kirim_barang')
                                  ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                  ->where('tb_kirim_barang.id','=',$noPengiriman)
                                  ->update(['status_pengiriman' => 'terkirim']);

           #barang Ada
          }else if(count($cek) >= 1){
            #Ambil detail barang di tabel tb_barang gudang
            $detailBarang = DB::connection('aditiyamart_inventory')
                                   ->table('tb_barang')
                                   ->join('tb_barcode','tb_barang.id','=','tb_barcode.id_barang')
                                   ->where('barcode','=',$ambilBarcode[$i]->barcode)
                                   ->get();


             #Tambah Stok Toko
             $tambahStokToko = DB::table('tb_stok')
                                 ->where('barcode','=',$ambilBarcode[$i]->barcode)
                                 ->update(['jumlah' => $cek[0]->jumlah + $ambilBarcode[$i]->jumlah]);

             #Ambil stok gudang
             $stokGudang = $detailBarang[0]->stok_tersedia;

             #Kurangi Stok Gudang
             $detailBarang = DB::connection('aditiyamart_inventory')
                                  ->table('tb_barang')
                                  ->join('tb_barcode','tb_barang.id','tb_barcode.id_barang')
                                  ->where('barcode','=',$ambilBarcode[$i]->barcode)
                                  ->update(['stok_tersedia' => $stokGudang - $ambilBarcode[$i]->jumlah]);


             #Update Status Barang yang di kirim
             $detailBarang = DB::connection('aditiyamart_inventory')
                                  ->table('tb_kirim_barang')
                                  ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                  ->where('tb_kirim_barang.id','=',$noPengiriman)
                                  ->update(['status_pengiriman' => 'terkirim']);

          }

        }

  }

  public function cetakKartuPengiriman($noPengiriman=null)
  {
        $detailKirimBarang = DB::connection('aditiyamart_inventory')
                             ->table('tb_kirim_barang')
                             ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                             ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                             ->join('tb_barang','tb_barcode.id_barang','tb_barang.id')
                             ->where('tb_kirim_barang.id','=',$noPengiriman)
                             ->get();
       return view('inventory.kirim.cetakKartuPengiriman',['detailPengiriman' => $detailKirimBarang,
                                                           'noPengiriman' => $noPengiriman
                                                          ]);
  }

}
