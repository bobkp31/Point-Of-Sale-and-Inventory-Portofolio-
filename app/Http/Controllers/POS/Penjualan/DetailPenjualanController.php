<?php

namespace App\Http\Controllers\POS\Penjualan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DetailPenjualanController extends Controller
{
    private $persentaseDiskonPenjualan = 0;
    private $idIndukDiskonPenjualan;

    public function kotakPemberitahuanDiskon()
    {
      return view('pos.pages.penjualan.kotakPemberitahuanDiskon');
    }

    public function kotakDetailTransaksi()
    {
      $date = date('Y-m-d');
      $detailTransaksi = DB::select('SELECT  SUM(subtotal) AS total,
                                             SUM(nilai_diskon) AS totalDiskon,
                                             SUM(qty) AS totalItem
                                     FROM tb_transaksi
                                     INNER JOIN tb_transaksi_penjualan USING(id_transaksi)
                                     WHERE status="proses"');

      #cek Diskon penjualan
      $cekDiskonTransaksi = self::cekDiskonPenjualan($detailTransaksi[0]->total);

      #hitung diskon penjualan
      $diskonTransaksi = $detailTransaksi[0]->total * ($this->persentaseDiskonPenjualan / 100);

      #ambil id Penjualan
      $tbTransaksiPenjualan = DB::table('tb_transaksi_penjualan')
                                      ->where('status','=','proses')
                                      ->get();

      #total Penjualan
      $totalPenjualan = DB::table('tb_penjualan')
                            ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',$date)
                            ->sum('total');
      // dd($diskonTransaksi);


      return view('pos.pages.penjualan.kotakDetailTransaksi',['detailTransaksi' => $detailTransaksi,
                                                              'diskonTransaksi' => $diskonTransaksi,
                                                              'noPenjualan'  => $tbTransaksiPenjualan,
                                                              'tranSaksiHariIni' => $totalPenjualan]);
    }

    public function bayarTransaksi(Request $request)
    {
        $noPenjualan = $request->noPenjualan;
        $now = date('Y-m-d H:i:s');
        $tabelDiskonPenjualan = DB::select('select * from tb_diskon_penjualan
                                            inner join tb_induk_diskon_penjualan
                                            using(id_induk_diskon_penjualan)
                                            limit 1');

        # Ambil data dari tabel tb_transaksi_penjualan
        $transaksiPenjualan = DB::select('SELECT * FROM tb_transaksi_penjualan
                                          WHERE status = "proses"');

        $jenisPembayaran   = $request->jenisPembayaran;
        $totalTransaksi    = $request->totalTransaksi;
        $nominalPembayaran = $request->nominalPembayaran;
        $kembalian         = $request->kembalian;
        $diskonPenjualan   = $request->totalPotonganTransaksi;
        $nip = session('nip');

        // return $jenisPembayaran.' '.$totalTransaksi.' '.$nominalPembayaran.' '.$kembalian.' '.$diskonPenjualan;


        $tbTransaksi = DB::table('tb_transaksi_penjualan')
                      ->join('tb_transaksi','tb_transaksi_penjualan.id_transaksi','=','tb_transaksi.id_transaksi')
                      ->where('status','proses')
                      ->get();


        #1. update tabel tb_penjualan
        $updateTbPenjualan = DB::table('tb_penjualan')
                                 ->where('no_penjualan','=',$transaksiPenjualan[0]->no_penjualan)
                                 ->update(['total' => $totalTransaksi,
                                           'pajak' => 0,
                                           'jenis_pembayaran' => $jenisPembayaran,
                                           'nominal_pembayaran' => $nominalPembayaran
                                         ]);

        #2. update tabel tb_transaksi_penjualan
        $updateTbPenjualan = DB::update('update tb_transaksi_penjualan
                                         set status="berhasil"
                                         where no_penjualan ='.$transaksiPenjualan[0]->no_penjualan.
                                        ' and status="proses"');


        #3. Jika ada diskon Penjualan tambah tabel tb_detail_diskon_penjualan
        if ($diskonPenjualan != 0){
          $detailDiskonPenjualan = DB::table('tb_detail_diskon_penjualan')
                                      ->insert(['no_penjualan' => $transaksiPenjualan[0]->no_penjualan,
                                                'id_induk_diskon_penjualan' => $tabelDiskonPenjualan[0]->id_induk_diskon_penjualan,
                                                'total' => $diskonPenjualan]);

        }
        //
        #4. Tambah no_penjualan di tabel tb_penjualan
        $tambah = DB::insert('INSERT INTO tb_penjualan(id_pegawai,waktu,total,pajak,jenis_pembayaran,nominal_pembayaran)
                              VALUES (?,?,?,?,?,?)',[$nip,$now,0,0,'tunai',0]);

        #5. hapus dummy simpan no penjualan
            $cekdummynopenjualan = DB::select('select * from dummy_simpan_no_penjualan
                                                 order by no_penjualan desc limit 1');
            if(!empty($cekdummynopenjualan)){
              #hapus dummy no penjualan
              $hapusdummynopenjualan = DB::delete('delete from dummy_simpan_no_penjualan
                                                   where no_penjualan = ?',[$noPenjualan]);
            }


        # Ambil id penjualan yang status nya sukses
        return $transaksiPenjualan;

    }

    public function cekDiskonPenjualan($totalTransaksi)
    {

        $now = date('Y-m-d H:i:s');
        $diskonPenjualan = DB::table('tb_diskon_penjualan')
                               ->join('tb_induk_diskon_penjualan','tb_diskon_penjualan.id_induk_diskon_penjualan','=','tb_induk_diskon_penjualan.id_induk_diskon_penjualan')
                               ->get();
        // return count($diskonPenjualan);

        if(count($diskonPenjualan) != 0){

          if($diskonPenjualan[0]->tgl_berlaku <= $now && $diskonPenjualan[0]->tgl_berakhir >= $now
             && $diskonPenjualan[0]->minimum_pembelian <= $totalTransaksi ){

              $this->persentaseDiskonPenjualan = $diskonPenjualan[0]->persentase;
              $this->idIndukDiskonPenjualan = $diskonPenjualan[0]->id_induk_diskon_penjualan;
              // return $this->persentaseDiskonPenjualan;
          }else{
              $this->persentaseDiskonPenjualan = 0;
              $this->idIndukDiskonPenjualan = 0;
              // return $this->persentaseDiskonPenjualan;
          }
        }else if (count($diskonPenjualan) == 0){
          $this->persentaseDiskonPenjualan = 0;
          $this->idIndukDiskonPenjualan = 0;
          // return 'kosong';
        }



    }

    public function cobaDiskonPenjualan()
    {
      $cek = self::cekDiskonPenjualan(30000);
      return $cek;
    }


    public function getTransaksiDiProses()
    {
      $tb_transaksi = DB::table('tb_transaksi')
                   ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                   ->join('tb_stok','tb_transaksi.barcode','=','tb_stok.barcode')
                   ->where('tb_transaksi_penjualan.status','=','proses')
                   ->get();
        return view('pos.pages.penjualan.tabelHapusTransaksi',['transaksi' => $tb_transaksi]);
    }

    public function hapusTransaksi(Request $request)
    {

      $id = $request->id;
      $qty = $request->qty;


      $tbTransaksi = DB::table('tb_transaksi_penjualan')
                         ->join('tb_transaksi','tb_transaksi_penjualan.id_transaksi','=','tb_transaksi.id_transaksi')
                         ->where('id_transaksi_penjualan','=',$id)
                         ->get();

      $hapusTransaksi = DB::table('tb_transaksi_penjualan')
                            ->where('id_transaksi_penjualan','=',$id)
                            ->update(['status' => 'batal']);

      $updateStok = DB::update('UPDATE tb_stok SET jumlah = jumlah + ? WHERE barcode = ?',[$qty,$tbTransaksi[0]->barcode]);



      // return $barcode;
    }

    public function ubahTransaksi(Request $request)
    {
      $id = $request->id;
      $idStok = $request->idStok;
      $qty = $request->qty;
      $qtyEdit = $request->qtyEdit;
      $qtyAkhir = 0;

      #variabel Diskon
      $diskonItem = 0;
      $diskonMininumItem = 0;

      #2. Ambil qty dari tb_stok
      $tbStok = DB::table('tb_stok')
                    ->where('id_stok','=',$idStok)
                    ->get();


      #cek Diskon transaksi
      $cekDiskon = DB::table('tb_diskon_item')
                    ->join('tb_induk_diskon_item','tb_diskon_item.id_induk_diskon_item','tb_induk_diskon_item.id_induk_diskon_item')
                    ->whereRaw('tgl_berlaku <= now() and tgl_berakhir >= now() and barcode = ?',$tbStok[0]->barcode)
                    ->get();

      $cekDiskonMinimum = DB::table('tb_diskon_minimum_item')
                    ->join('tb_induk_diskon_item','tb_diskon_minimum_item.id_induk_diskon_item','tb_induk_diskon_item.id_induk_diskon_item')
                    ->whereRaw('tgl_berlaku <= now()
                                and tgl_berakhir >= now()
                                and barcode = '.$tbStok[0]->barcode.'
                                and tb_diskon_minimum_item.qty_pembelian <='.$qtyEdit.'')
                    ->get();

      if(count($cekDiskon) > 0){
        $diskonItem = $tbStok[0]->harga_jual * ($cekDiskon[0]->persentase/ 100);
      }else if(count($cekDiskon) <= 0){
        $diskonItem = 0;
      }

      if (count($cekDiskonMinimum) <= 0){
          $diskonMininumItem = 0;
      }else if(count($cekDiskonMinimum) > 0){
          $diskonMininumItem = ($tbStok[0]->harga_jual - $diskonItem ) * ($cekDiskonMinimum[0]->persentase / 100);
      }

      $hasil = (($tbStok[0]->harga_jual - $diskonItem) - $diskonMininumItem ) * $qtyEdit;
      #1. ubah qty transaksi
      $ubahQtyTransaksi = DB::table('tb_transaksi_penjualan')
                            ->join('tb_transaksi','tb_transaksi_penjualan.id_transaksi','=','tb_transaksi.id_transaksi')
                            ->where('id_transaksi_penjualan','=',$id)
                            ->update(['qty' => $qtyEdit,
                                      'subtotal' => $hasil,
                                      'nilai_diskon' => ($diskonItem + $diskonMininumItem) * $qtyEdit]);


      #3. update tb_stok
      if($qtyEdit > $qty){
          $qtyAkhir = $qtyEdit - $qty;
          $updateStok = DB::table('tb_stok')
          ->where('barcode','=',$tbStok[0]->barcode)
          ->update(['jumlah' => $tbStok[0]->jumlah - $qtyAkhir]);
      }else if($qtyEdit < $qty){
          $qtyAkhir = $qty - $qtyEdit;
          $updateStok = DB::table('tb_stok')
          ->where('barcode','=',$tbStok[0]->barcode)
          ->update(['jumlah' => $tbStok[0]->jumlah + $qtyAkhir]);
      }

    }

    #print Bill
    public function printBill($id=null)
    {
        // return $id;

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
                               ->sum('total');


        $totalDiskon = $diskonPenjualan + $detailTransaksi[0]->totalDiskon;

        // Ambil Total Penjualan
        $tbPenjualan = DB::table('tb_penjualan')
                           ->where('no_penjualan','=',$id)
                           ->get();

        return view('pos.pages.penjualan.cetakTransaksi',['tbTransaksi' => $tbTransaksi,
                                                          'noPenjualan' => $id,
                                                          'detailTransaksi' => $detailTransaksi,
                                                          'totalBayar' => $tbPenjualan,
                                                          'totalDiskon' => $totalDiskon]);
    }

    public function rekapKas(Request $request)
    {
        $nip = session('nip');
        $username = session('username');
        $now = date('Y-m-d');
        $sekarang = date('Y-m-d H:i:s');
        $waktusekarang = explode(" ",$sekarang);
        $tanggalSekarang = $waktusekarang[0];

        #1. Ambil total penjualan berdasarkan id pegawai
        $totalRekap = DB::table('tb_penjualan')
                           ->where('id_pegawai','=',$nip)
                           ->whereRaw('date_format(waktu,"%Y-%m-%d") = ?',[$now])
                           ->sum('total');

        #2. Update Tabel Rekap kas
        $updateKasKasir = DB::update('UPDATE tb_kas_kasir SET rekap = ?,
                                                          waktu_rekap = ?
                                      WHERE DATE_FORMAT(waktu_setor,"%Y-%m-%d") = ?
                                      AND username = ?',
                                      [$totalRekap,$sekarang,$now,$username]);

        #3. Ambil Kas Kasir Terbaru
        $tbKasKasir = DB::table('tb_kas_kasir')
                          ->where('username','=',$username)
                          ->whereDate('waktu_setor','=',$tanggalSekarang)
                          ->get();

        return view('pos.pages.penjualan.tabelRekapKasKasir',['kasKasir' => $tbKasKasir]);

    }

    public function prosesTransaksiSimpan(Request $request)
    {
        $noPenjualan = $request->noPenjualan;
        #1. ubah status jadi proses
        $update = DB::table('tb_transaksi_penjualan')
                      ->where('no_penjualan','=',$noPenjualan)
                      ->where('status','=','simpan')
                      ->update(['status' => 'proses']);

        #2. tambah no penjualan ke dummy simpan no penjualan
        $dummyNoPenjualan = DB::table('dummy_simpan_no_penjualan')
                                ->insert(['no_penjualan' => $noPenjualan]);

    }
}
