<?php

namespace App\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    public function laporanPenjualan()
    {
        return view('laporan.laporanPenjualan');
    }

    public function tampilLaporanPenjualanHarian(Request $request)
    {
        $hari = $request->hari;

        if(isset($hari)){
          #1. Ambil total quantity transaksi dan total diskon item
          $totalQty = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                          ->sum('qty');

          #2. Ambil Total Diskon Item
          $totalDiskonItem = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                          ->sum('nilai_diskon');

          #3. Ambil Total Diskon Penjualan
          $totalDiskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                          ->join('tb_penjualan','tb_detail_diskon_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                          ->sum('tb_detail_diskon_penjualan.total');


          #4. Ambil total Tunai
          $totalTunai = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','tunai')
                          ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                          ->sum('total');


          #5. Ambil total Debit
          $totalDebit = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','debit')
                          ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                          ->sum('total');

          #6. Total Tunai Dan Debit
          $totalTunaiDebit = $totalTunai+$totalDebit;

          #7. Ambil total Hpp
          $totalHpp = DB::select('SELECT SUM(hpp*qty) AS totalHpp
                                  FROM tb_transaksi_penjualan
                                  INNER JOIN tb_transaksi using(id_transaksi)
                                  INNER JOIN tb_stok USING(barcode)
                                  INNER JOIN tb_penjualan USING(no_penjualan)
                                  WHERE DATE_FORMAT(waktu,"%Y-%m-%d") = ?
                                  AND tb_transaksi_penjualan.status = ?',[$hari,'berhasil']);


          #8. Margin
          $margin = ($totalTunaiDebit - ($totalDiskonItem-$totalDiskonPenjualan))-$totalHpp[0]->totalHpp;

          #9. Detail Penjualan Produk
          $detailProduk = DB::select('SELECT sum(qty) AS totalQty,sum(subtotal) AS total,nama_barang
                                      FROM tb_transaksi
                                      INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                      INNER JOIN tb_penjualan USING(no_penjualan)
                                      INNER JOIN tb_stok USING(barcode)
                                      WHERE tb_transaksi_penjualan.status = ?
                                      AND date_format(waktu,"%Y-%m-%d") = ?
                                      GROUP BY nama_barang',['berhasil',$hari]);


          // return $detailProduk;
          return view('laporan.laporanPenjualan.tampilLaporanPenjualanHarian',['hari' => $hari,
                                                                               'totalQty' => $totalQty,
                                                                               'totalDiskonItem' => $totalDiskonItem,
                                                                               'totalDiskonPenjualan' => $totalDiskonPenjualan,
                                                                               'totalTunai' => $totalTunai,
                                                                               'totalDebit' => $totalDebit,
                                                                               'totalTunaiDebit' => $totalTunaiDebit,
                                                                               'totalHpp' => $totalHpp[0]->totalHpp,
                                                                               'margin' => $margin,
                                                                               'detailProduk' => $detailProduk]);

        }elseif (!isset($hari)) {
          return 'Pilih hari dulu !!';
        }
    }

    public function tampilLaporanPenjualanBulanan(Request $request)
    {
        $bulan = $request->bulan;
        // return $bulan;
        if(isset($bulan)){
          #1. Ambil total quantity transaksi dan total diskon item
          $totalQty = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('qty');

          #2. Ambil Total Diskon Item
          $totalDiskonItem = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('nilai_diskon');


          #3. Ambil Total Diskon Penjualan
          $totalDiskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                          ->join('tb_penjualan','tb_detail_diskon_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('tb_detail_diskon_penjualan.total');



          #4. Ambil total Tunai
          $totalTunai = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','tunai')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('total');


          #5. Ambil total Debit
          $totalDebit = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','debit')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('total');

          #6. Total Tunai Dan Debit
          $totalTunaiDebit = $totalTunai+$totalDebit;

          #7. Ambil total Hpp
          $totalHpp = DB::select('SELECT SUM(hpp*qty) AS totalHpp
                                  FROM tb_transaksi_penjualan
                                  INNER JOIN tb_transaksi using(id_transaksi)
                                  INNER JOIN tb_stok USING(barcode)
                                  INNER JOIN tb_penjualan USING(no_penjualan)
                                  WHERE DATE_FORMAT(waktu,"%Y-%m") = ?
                                  AND tb_transaksi_penjualan.status = ?',[$bulan,'berhasil']);


          #8. Margin
          $margin = ($totalTunaiDebit - ($totalDiskonItem-$totalDiskonPenjualan))-$totalHpp[0]->totalHpp;

          #9. Detail Penjualan Produk
          $detailProduk = DB::select('SELECT sum(qty) AS totalQty,sum(subtotal) AS total,nama_barang
                                      FROM tb_transaksi
                                      INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                      INNER JOIN tb_penjualan USING(no_penjualan)
                                      INNER JOIN tb_stok USING(barcode)
                                      WHERE tb_transaksi_penjualan.status = ?
                                      AND date_format(waktu,"%Y-%m") = ?
                                      GROUP BY nama_barang',['berhasil',$bulan]);



          // return $detailProduk;
          return view('laporan.laporanPenjualan.tampilLaporanPenjualanBulanan',['bulan' => $bulan,
                                                                               'totalQty' => $totalQty,
                                                                               'totalDiskonItem' => $totalDiskonItem,
                                                                               'totalDiskonPenjualan' => $totalDiskonPenjualan,
                                                                               'totalTunai' => $totalTunai,
                                                                               'totalDebit' => $totalDebit,
                                                                               'totalTunaiDebit' => $totalTunaiDebit,
                                                                               'totalHpp' => $totalHpp[0]->totalHpp,
                                                                               'margin' => $margin,
                                                                               'detailProduk' => $detailProduk]);

        }elseif (!isset($bulan)) {
          return 'Pilih Bulan dulu !!';
        }

    }

    public function cetakLaporanPenjualanHarian($hari)
    {
        // $hari = $request->hari;

        #1. Ambil total quantity transaksi dan total diskon item
        $totalQty = DB::table('tb_transaksi')
                        ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                        ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                        ->where('status','=','berhasil')
                        ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                        ->sum('qty');

        #2. Ambil Total Diskon Item
        $totalDiskonItem = DB::table('tb_transaksi')
                        ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                        ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                        ->where('status','=','berhasil')
                        ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                        ->sum('nilai_diskon');

        #3. Ambil Total Diskon Penjualan
        $totalDiskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                        ->join('tb_penjualan','tb_detail_diskon_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                        ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                        ->sum('tb_detail_diskon_penjualan.total');


        #4. Ambil total Tunai
        $totalTunai = DB::table('tb_penjualan')
                        ->where('jenis_pembayaran','=','tunai')
                        ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                        ->sum('total');


        #5. Ambil total Debit
        $totalDebit = DB::table('tb_penjualan')
                        ->where('jenis_pembayaran','=','debit')
                        ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$hari])
                        ->sum('total');

        #6. Total Tunai Dan Debit
        $totalTunaiDebit = $totalTunai+$totalDebit;

        #7. Ambil total Hpp
        $totalHpp = DB::select('SELECT SUM(hpp*qty) AS totalHpp
                                FROM tb_transaksi_penjualan
                                INNER JOIN tb_transaksi using(id_transaksi)
                                INNER JOIN tb_stok USING(barcode)
                                INNER JOIN tb_penjualan USING(no_penjualan)
                                WHERE DATE_FORMAT(waktu,"%Y-%m-%d") = ?
                                AND tb_transaksi_penjualan.status = ?',[$hari,'berhasil']);


        #8. Margin
        $margin = ($totalTunaiDebit - ($totalDiskonItem-$totalDiskonPenjualan))-$totalHpp[0]->totalHpp;

        #9. Detail Penjualan Produk
        $detailProduk = DB::select('SELECT sum(qty) AS totalQty,sum(subtotal) AS total,nama_barang
                                    FROM tb_transaksi
                                    INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                    INNER JOIN tb_penjualan USING(no_penjualan)
                                    INNER JOIN tb_stok USING(barcode)
                                    WHERE tb_transaksi_penjualan.status = ?
                                    AND date_format(waktu,"%Y-%m-%d") = ?
                                    GROUP BY nama_barang',['berhasil',$hari]);


        // return $detailProduk;
        return view('laporan.laporanPenjualan.cetakLaporanPenjualanHarian',['hari' => $hari,
                                                                             'totalQty' => $totalQty,
                                                                             'totalDiskonItem' => $totalDiskonItem,
                                                                             'totalDiskonPenjualan' => $totalDiskonPenjualan,
                                                                             'totalTunai' => $totalTunai,
                                                                             'totalDebit' => $totalDebit,
                                                                             'totalTunaiDebit' => $totalTunaiDebit,
                                                                             'totalHpp' => $totalHpp[0]->totalHpp,
                                                                             'margin' => $margin,
                                                                             'detailProduk' => $detailProduk]);

    }

    public function cetakLaporanPenjualanBulanan($bulan)
    {

          #1. Ambil total quantity transaksi dan total diskon item
          $totalQty = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('qty');

          #2. Ambil Total Diskon Item
          $totalDiskonItem = DB::table('tb_transaksi')
                          ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                          ->join('tb_penjualan','tb_transaksi_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->where('status','=','berhasil')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('nilai_diskon');


          #3. Ambil Total Diskon Penjualan
          $totalDiskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                          ->join('tb_penjualan','tb_detail_diskon_penjualan.no_penjualan','=','tb_penjualan.no_penjualan')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('tb_detail_diskon_penjualan.total');



          #4. Ambil total Tunai
          $totalTunai = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','tunai')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('total');


          #5. Ambil total Debit
          $totalDebit = DB::table('tb_penjualan')
                          ->where('jenis_pembayaran','=','debit')
                          ->whereRaw('date_format(waktu,"%Y-%m") = ?',[$bulan])
                          ->sum('total');

          #6. Total Tunai Dan Debit
          $totalTunaiDebit = $totalTunai+$totalDebit;

          #7. Ambil total Hpp
          $totalHpp = DB::select('SELECT SUM(hpp*qty) AS totalHpp
                                  FROM tb_transaksi_penjualan
                                  INNER JOIN tb_transaksi using(id_transaksi)
                                  INNER JOIN tb_stok USING(barcode)
                                  INNER JOIN tb_penjualan USING(no_penjualan)
                                  WHERE DATE_FORMAT(waktu,"%Y-%m") = ?
                                  AND tb_transaksi_penjualan.status = ?',[$bulan,'berhasil']);


          #8. Margin
          $margin = ($totalTunaiDebit - ($totalDiskonItem-$totalDiskonPenjualan))-$totalHpp[0]->totalHpp;

          #9. Detail Penjualan Produk
          $detailProduk = DB::select('SELECT sum(qty) AS totalQty,sum(subtotal) AS total,nama_barang
                                      FROM tb_transaksi
                                      INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                      INNER JOIN tb_penjualan USING(no_penjualan)
                                      INNER JOIN tb_stok USING(barcode)
                                      WHERE tb_transaksi_penjualan.status = ?
                                      AND date_format(waktu,"%Y-%m") = ?
                                      GROUP BY nama_barang',['berhasil',$bulan]);



          // return $detailProduk;
          return view('laporan.laporanPenjualan.cetakLaporanPenjualanBulanan',['bulan' => $bulan,
                                                                               'totalQty' => $totalQty,
                                                                               'totalDiskonItem' => $totalDiskonItem,
                                                                               'totalDiskonPenjualan' => $totalDiskonPenjualan,
                                                                               'totalTunai' => $totalTunai,
                                                                               'totalDebit' => $totalDebit,
                                                                               'totalTunaiDebit' => $totalTunaiDebit,
                                                                               'totalHpp' => $totalHpp[0]->totalHpp,
                                                                               'margin' => $margin,
                                                                               'detailProduk' => $detailProduk]);


    }

}
