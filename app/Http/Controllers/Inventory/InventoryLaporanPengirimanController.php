<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryLaporanPengirimanController extends Controller
{
      public function laporanPengiriman()
      {
          return view('inventory.laporan.laporanPengiriman');
      }

      public function detailLaporanPengirimanHarian(Request $request)
      {
          // return view('inventory.laporan.laporanPengirimanHarian')
          $hari = $request->hari;

          $pengirimanHarian = DB::connection('aditiyamart_inventory')
                                  ->table('tb_kirim_barang')
                                  ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                  ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                                  ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                                  ->select('tb_barang.nama_barang','tb_detail_kirim_barang.*','tb_kirim_barang.waktu')
                                  ->whereDate('waktu','=',$hari)
                                  ->get();

          $totalPengiriman = DB::connection('aditiyamart_inventory')
                                  ->table('tb_detail_kirim_barang')
                                  ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                  ->whereDate('waktu','=',$hari)
                                  ->sum('jumlah');


          return view('inventory.laporan.laporanPengirimanHarian',['pengirimanHarian' => $pengirimanHarian,
                                                                   'totalPengiriman'  => $totalPengiriman,
                                                                   'hari' => $hari]);
          // return $totalPengiriman;
      }

      public function cetakLaporanPengirimanHarian($hari)
      {
        $pengirimanHarian = DB::connection('aditiyamart_inventory')
                                ->table('tb_kirim_barang')
                                ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                                ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                                ->select('tb_barang.nama_barang','tb_detail_kirim_barang.*','tb_kirim_barang.waktu')
                                ->whereDate('waktu','=',$hari)
                                ->get();

        $totalPengiriman = DB::connection('aditiyamart_inventory')
                                ->table('tb_detail_kirim_barang')
                                ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                ->whereDate('waktu','=',$hari)
                                ->sum('jumlah');


        return view('inventory.laporan.cetakLaporanPengirimanHarian',['pengirimanHarian' => $pengirimanHarian,
                                                                 'totalPengiriman'  => $totalPengiriman,
                                                                 'hari' => $hari]);
      }



      public function detailLaporanPengirimanBulanan(Request $request)
      {
          // return view('inventory.laporan.laporanPengirimanHarian')
          $bulan = $request->bulan;

          $pengirimanHarian = DB::connection('aditiyamart_inventory')
                                  ->table('tb_kirim_barang')
                                  ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                  ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                                  ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                                  ->select('tb_barang.nama_barang','tb_detail_kirim_barang.*','tb_kirim_barang.waktu')
                                  ->whereRaw('date_format(waktu,"%Y-%m") = ? ',[$bulan])
                                  ->get();

          $totalPengiriman = DB::connection('aditiyamart_inventory')
                                  ->table('tb_detail_kirim_barang')
                                  ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                  ->whereRaw('date_format(waktu,"%Y-%m") = ? ',[$bulan])
                                  ->sum('jumlah');


          return view('inventory.laporan.laporanPengirimanBulanan',['pengirimanHarian' => $pengirimanHarian,
                                                                   'totalPengiriman'  => $totalPengiriman,
                                                                   'bulan' => $bulan]);
          // return $totalPengiriman;
      }

      public function cetakLaporanPengirimanBulanan($bulan)
      {
        $pengirimanHarian = DB::connection('aditiyamart_inventory')
                                ->table('tb_kirim_barang')
                                ->join('tb_detail_kirim_barang','tb_kirim_barang.id','=','tb_detail_kirim_barang.id_kirim_barang')
                                ->join('tb_barcode','tb_detail_kirim_barang.barcode','=','tb_barcode.barcode')
                                ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                                ->select('tb_barang.nama_barang','tb_detail_kirim_barang.*','tb_kirim_barang.waktu')
                                ->whereRaw('date_format(waktu,"%Y-%m") = ? ',[$bulan])
                                ->get();

        $totalPengiriman = DB::connection('aditiyamart_inventory')
                                ->table('tb_detail_kirim_barang')
                                ->join('tb_kirim_barang','tb_detail_kirim_barang.id_kirim_barang','=','tb_kirim_barang.id')
                                ->whereRaw('date_format(waktu,"%Y-%m") = ? ',[$bulan])
                                ->sum('jumlah');


        return view('inventory.laporan.cetakLaporanPengirimanBulanan',['pengirimanHarian' => $pengirimanHarian,
                                                                 'totalPengiriman'  => $totalPengiriman,
                                                                 'bulan' => $bulan]);
      }
}
