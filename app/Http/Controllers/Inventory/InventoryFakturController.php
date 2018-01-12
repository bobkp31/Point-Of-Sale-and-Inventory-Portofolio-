<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryFakturController extends Controller
{
     public function formTambahFaktur(Request $request)
     {
          $noFaktur = $request->noFaktur;
          $idPemasok = $request->idPemasok;

          $cekTbFaktur = DB::connection('aditiyamart_inventory')
                            ->table('tb_faktur')
                            ->join('tb_detail_faktur','tb_detail_faktur.id_faktur','=','tb_faktur.id')
                            ->join('tb_barcode','tb_barcode.barcode','=','tb_detail_faktur.barcode')
                            ->join('tb_barang','tb_barang.id','=','tb_barcode.id_barang')
                            ->where('tb_faktur.no_faktur','=',$noFaktur)
                            ->where('nama_pemasok','=',$idPemasok)
                            ->where('status_input','=','proses')
                            ->get();

          return view('inventory.faktur.formTambahFaktur',['tbFaktur' => $cekTbFaktur]);
     }

     public function daftarTambahFaktur(Request $request)
     {
         $noFaktur = $request->noFaktur;
         $idPemasok = $request->idPemasok;

         #Ambil id Faktur untuk di join dengan detail faktur
         $faktur = DB::connection('aditiyamart_inventory')
                           ->table('tb_faktur')
                           ->where('no_faktur','=',$noFaktur)
                           ->where('nama_pemasok','=',$idPemasok)
                           ->where('status_input','=','proses')
                           ->first();


         if(count($faktur) <= 0){
           return 'tidak ada faktur';
         }else if(count($faktur) > 0){
           #Detail Faktur yang Sudah di inputkan
           $detailFaktur = DB::connection('aditiyamart_inventory')
                                  ->table('tb_detail_faktur')
                                  ->join('tb_faktur','tb_faktur.id','=','tb_detail_faktur.id_faktur')
                                  ->join('tb_barcode','tb_barcode.barcode','=','tb_detail_faktur.barcode')
                                  ->join('tb_barang','tb_barang.id','=','tb_barcode.id_barang')
                                  ->where('tb_detail_faktur.id_faktur','=',$faktur->id)
                                  ->where('tb_faktur.status_input','=','proses')
                                  ->get();
          // return $detailFaktur;
           return view('inventory.faktur.daftarTambahFaktur',['detailFaktur' => $detailFaktur]);
         }


     }

     public function tambahFaktur(Request $request)
     {
        $sekarang = date('Y-m-d H-i-s');
        $noFaktur = $request->noFaktur;
        $idPemasok = $request->idPemasok;

        if(empty($noFaktur)){
           return "kosong";
        }else{
           #Cek Tabel Faktur
           $cekTbFaktur = DB::connection('aditiyamart_inventory')
                             ->table('tb_faktur')
                             ->where('no_faktur','=',$noFaktur)
                             ->where('nama_pemasok','=',$idPemasok)
                             ->where('status_input','=','proses')
                             ->get();

           if(count($cekTbFaktur) <= 0){
              #Tambah tabel tb_faktur
              $tambahFaktur = DB::connection('aditiyamart_inventory')
                                ->table('tb_faktur')
                                ->insert([
                                          'no_faktur'  => $noFaktur,
                                          'nama_pemasok' => $idPemasok,
                                          'waktu_input'=> $sekarang,
                                          'nip'        => session('nip'),
                                          'status_input' => 'proses',
                                          'status_pembayaran' => 'belum'
                                        ]);
              return 'masuk';
           }else if(count($cekTbFaktur) > 0){
              return 'sudah ada';
           }
        }
     }

     # Update faktur setelah semua detail faktur masuk
     public function updateFaktur(Request $request)
     {
        $sekarang = date('Y-m-d H-i-s');
        $tanggalJatuhTempo = $request->tanggalJatuhTempo;
        $tanggalOrder = $request->tanggalOrder;
        $total = $request->total;
        $totalPotongan = $request->totalPotongan;
        $tanggalJatuhTempo = $request->tanggalJatuhTempo;
        $totalBayar = $request->totalBayar;
        $keterangan = $request->keterangan;
        $noFaktur = $request->noFaktur;
        $idPemasok = $request->idPemasok;

        // return $sekarang.' '.$tanggalJatuhTempo.' '.$tanggalOrder.' '.$total.' '.$totalPotongan.' '.$tanggalJatuhTempo.' '.$totalBayar.' '.$keterangan;
        if(empty($tanggalJatuhTempo)){
            return 'jatuh tempo kosong';
        }else if(empty($tanggalOrder)){
            return 'tanggal order kosong';
        }else if(empty($total)){
            return 'total kosong';
        }else if(empty($totalPotongan)){
            return 'total potongan kosong';
        }else if(empty($totalBayar)){
            return 'total bayar kosong';
        }else if(empty($noFaktur)){
            return 'nomor faktur kosong';
        }else{
          #update tabel Faktur
          $updateFaktur = DB::connection('aditiyamart_inventory')
                                  ->table('tb_faktur')
                                  ->where('no_faktur','=',$noFaktur)
                                  ->where('nama_pemasok','=',$idPemasok)
                                  ->where('status_input','=','proses')
                                  ->update([
                                            'tanggal_order' => $tanggalOrder,
                                            'tanggal_jatuh_tempo'  => $tanggalJatuhTempo,
                                            'total_harga' => $total,
                                            'total_potongan'  => $totalPotongan,
                                            'total_tagihan' => $totalBayar,
                                            'keterangan'  => $keterangan,
                                            'waktu_input'  => $sekarang,
                                            'status_input'  => 'berhasil'
                                           ]);
          return 'ok';

        }

     }

     public function cariBarcodeFaktur(Request $request)
     {
         $barcode = $request->barcode;
         $cariBarcode = DB::connection('aditiyamart_inventory')
                            ->table('tb_barcode')
                            ->join('tb_barang','tb_barang.id','=','tb_barcode.id_barang')
                            ->where('tb_barcode.barcode','=',$barcode)
                            ->get();

         if(count($cariBarcode) <= 0){
             return 'kosong';
         }else if(count($cariBarcode) > 0){
             return $cariBarcode;
         }
     }

     #TAMBAH DETAIL FAKTUR HA,,,HA,,,HA
     public function tambahDetailFaktur(Request $request)
     {
         $sekarang = date('Y-m-d H-i-s');
         $barcode = $request->barcode;
         $jumlah = $request->jumlah;
         $hargaSatuan = $request->hargaSatuan;
         $masaBerlaku = $request->masaBarlaku;
         $noFaktur = $request->noFaktur;
         $idPemasok = $request->idPemasok;

         #cari IdFaktur (bukan nofaktur)
         $cekTbFaktur = DB::connection('aditiyamart_inventory')
                           ->table('tb_faktur')
                           ->where('no_faktur','=',$noFaktur)
                           ->where('nama_pemasok','=',$idPemasok)
                           ->where('status_input','=','proses')
                           ->first();


         #cek nomor faktur
         if(empty($noFaktur)){
           return 'noFaktur Kosong';
         }else{
           $cariBarang = DB::connection('aditiyamart_inventory')
                              ->table('tb_barcode')
                              ->join('tb_barang','tb_barang.id','=','tb_barcode.id_barang')
                              ->where('tb_barcode.barcode','=',$barcode)
                              ->get();
           #cari selisih harga
           $selisihHarga = $hargaSatuan - $cariBarang[0]->harga_jual;


           #cari harga rata-rata untuk hpp baru
           $hargaRata2 = (( $cariBarang[0]->harga_jual * $cariBarang[0]->stok_tersedia)
                         + ($jumlah * $hargaSatuan))
                         / ($cariBarang[0]->stok_tersedia + $jumlah);

           #cari stok sebelum update
           $stokSebelumUpadate = $cariBarang[0]->stok_tersedia;

           #cari stok setelah update (stok baru)
           $stokSetelahUpadate = $cariBarang[0]->stok_tersedia + $jumlah;
          //  return $stokSetelahUpadate;

           #cek barang di tabel detail Faktur, jika sudah ada, kirim alert
           $cekDetailFaktur = DB::connection('aditiyamart_inventory')
                                  ->table('tb_detail_faktur')
                                  ->join('tb_faktur','tb_faktur.id','=','tb_detail_faktur.id_faktur')
                                  ->where('barcode','=',$barcode)
                                  ->where('status_input','=','proses')
                                  ->where('tb_faktur.id','=',$cekTbFaktur->id)
                                  ->get();

           if(count($cekDetailFaktur) > 0){
             return 'barang sudah ada';
           }else if(count($cekDetailFaktur) <= 0){
             # 1.Tambah Detail faktur
             $tambahDetailFaktur = DB::connection('aditiyamart_inventory')
                                     ->table('tb_detail_faktur')
                                     ->insert([
                                               'id_faktur'     => $cekTbFaktur->id,
                                               'barcode'       => $barcode,
                                               'jumlah_barang' => $jumlah,
                                               'harga_satuan'   => $hargaSatuan,
                                             ]);

             # 2.Riwayat Faktur faktur
             $tambahRiwayatFaktur = DB::connection('aditiyamart_inventory')
                                     ->table('tb_riwayat_faktur')
                                     ->insert([
                                               'barcode'         => $barcode,
                                               'no_faktur'       => $noFaktur,
                                               'harga_selisih'   => $selisihHarga,
                                               'harga_rata_rata' => $hargaRata2,
                                               'stok_sebelum_update' => $stokSebelumUpadate,
                                               'stok_sesudah_update' => $stokSetelahUpadate,
                                               'masa_barlaku'     => $masaBerlaku,
                                               'waktu_input'     => $sekarang
                                             ]);

            # 2.Update Stok Barang (tb_barang) dan update hpp
            $updateStokBarang = DB::connection('aditiyamart_inventory')
                                    ->table('tb_barang')
                                    ->join('tb_barcode','tb_barcode.id_barang','=','tb_barang.id')
                                    ->where('barcode','=',$barcode)
                                    ->update([
                                              'stok_tersedia' => $stokSetelahUpadate,
                                              'hpp'           => $hargaRata2
                                             ]);

           }
         }

     }


      public function cetakFaktur($noFaktur,$pemasok)
      {
          #detailFaktur
          $detailFaktur = DB::connection('aditiyamart_inventory')
                              ->table('tb_faktur')
                              ->join('tb_detail_faktur','tb_faktur.id','=','tb_detail_faktur.id_faktur')
                              ->join('tb_barcode','tb_detail_faktur.barcode','=','tb_barcode.barcode')
                              ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                              ->select('tb_faktur.*','tb_detail_faktur.*','tb_barang.nama_barang')
                              ->where('tb_faktur.no_faktur','=',$noFaktur)
                              ->where('tb_faktur.nama_pemasok','=',$pemasok)
                              ->get();

          // return $detailFaktur;

          return view('inventory.faktur.cetakFaktur',['detailFaktur' => $detailFaktur]);

      }

}
