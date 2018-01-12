<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class nevadaController extends Controller
{
    public function index()
    {
        return 'index nevada ';
    }

    public function setSession(Request $request)
    {
        $tb_akun = DB::connection('aditiyamart_kepegawaian')->table('tb_akun')
                       ->where('username','=','owner')
                       ->get();
        #set session
        $request->session()->put('hak_akses',$tb_akun[0]->hak_akses);

        return 'sessin Telah di set !';
    }

    public function viewSession(Request $request)
    {
       return session('nip');
    }

    public function delSession(Request $request)
    {
       $request->session()->flush();
       return 'session has delete !!';
    }


    public function printBill($id=null)
    {


        // return $noPenjualan;
        $tbTransaksi = DB::table('tb_transaksi')
                       ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                       ->join('tb_stok','tb_transaksi.barcode','=','tb_stok.barcode')
                       ->select('tb_transaksi.*','tb_transaksi_penjualan.*','tb_stok.nama_barang','tb_stok.harga_jual')
                       ->where('tb_transaksi_penjualan.status','=','berhasil')
                       ->where('tb_transaksi_penjualan.no_penjualan','=',$id)
                       ->get();
        // dd($tbTransaksi);

        $detailTransaksi = DB::select('SELECT  SUM(subtotal) AS total,
                                               SUM(nilai_diskon) AS totalDiskon,
                                               SUM(qty) AS totalItem
                                       FROM tb_transaksi
                                       INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                       WHERE status="berhasil"
                                       AND tb_transaksi_penjualan.no_penjualan ='.$id.'');


        // Ambil total diskon penjualan jika ada
        $diskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                               ->where('no_penjualan','=',$id)
                               ->get();

        // Ambil Total Penjualan
        $tbPenjualan = DB::table('tb_penjualan')
                           ->where('no_penjualan','=',$id)
                           ->get();

        return view('pos.pages.penjualan.cetakTransaksi',['tbTransaksi' => $tbTransaksi,
                                                          'noPenjualan' => $id,
                                                          'detailTransaksi' => $detailTransaksi,
                                                          'detailDiskonPenjualan' => $diskonPenjualan,
                                                          'totalBayar' => $tbPenjualan]);
    }

    public function routing2parameter($id1,$id2)
    {
       return $id1.' '.$id2;
    }
}
