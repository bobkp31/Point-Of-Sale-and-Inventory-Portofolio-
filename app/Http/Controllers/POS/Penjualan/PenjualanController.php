<?php

namespace App\Http\Controllers\POS\Penjualan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class PenjualanController extends Controller
{
    private $persentaseDiskonItem = 0;
    private $persentaseDiskonMinimumItem = 0;

    private $barcodeMinimumItem;
    private $qtyMinimum;

    //variabel id_transaksi dan no_penjualan
    private $idTransaksi;
    private $noPenjualan;

    public function index()
    {
        // return 'hello';
        return view('pos.pages.penjualan.penjualan');
    }


    public function inputSaldoAwal()
    {
        return view('pos.pages.penjualan.inputSaldoAwal');
    }

    public function inputSaldoAwalDatabase(Request $request)
    {
        $saldo = $request->inpSaldo;
        $now = date('Y-m-d H:i:s');

        #1. tambah tabel tb_kas_kasir
        $tambahSaldo = DB::table('tb_kas_kasir')
                           ->insert(['username' => session('username'),
                                     'setoran'  => $saldo,
                                     'rekap'    => 0,
                                     'waktu_setor' => $now]);

        return redirect('/pos/penjualan/index');
    }

    public function tabelTransaksi()
    {
      $tb_transaksi = DB::table('tb_transaksi')
                   ->join('tb_transaksi_penjualan','tb_transaksi.id_transaksi','=','tb_transaksi_penjualan.id_transaksi')
                   ->join('tb_stok','tb_transaksi.barcode','=','tb_stok.barcode')
                   ->where('tb_transaksi_penjualan.status','=','proses')
                   ->get();

        return view('pos.pages.penjualan.tabelTransaksi',['tb_transaksi' => $tb_transaksi]);
    }

    public function tabelSimpanTransaksi()
    {
        #1. Tambil kan semua transaksi yang statusnya di simpan
        $transaksiSimpan = DB::table('tb_transaksi_penjualan')
                               ->join('tb_transaksi','tb_transaksi_penjualan.id_transaksi','=','tb_transaksi.id_transaksi')
                               ->join('tb_stok','tb_transaksi.barcode','tb_stok.barcode')
                               ->select('tb_transaksi_penjualan.*','tb_transaksi.*','tb_stok.nama_barang','tb_stok.harga_jual')
                               ->where('tb_transaksi_penjualan.status','=','simpan')
                               ->get();

        // return $transaksiSimpan;
        return view('pos.pages.penjualan.tabelSimpanTransaksi',['transaksiSimpan'=>$transaksiSimpan]);
    }

    public function cariBarang(Request $request)
    {
        $barcode = $request->barcode;
        $qty = explode('i',$request->qty);
        $qtyBeli  = $qty[0];


        $tb_stok = DB::table('tb_stok')
                        ->where('barcode','=',$barcode)
                        ->get();

        $idPegawai = session('nip');
        $idPelanggan = 1;
        $waktu = date('Y-m-d H:i:s');
        $tglSekarang = date('Y-m-d');

       # 1. cek id dan status di tabel tb_transaksi_penjualan
       $cek1 = DB::select('select * from tb_transaksi_penjualan
                           order by id_transaksi_penjualan desc limit 1');
       # 1.1 Cek id terakhir tb_penjualan
       $tbPenjualan = DB::select('select * from tb_penjualan
                           order by no_penjualan desc limit 1');

       # 2. Jika tabel Transaksi Penjualan Kosong
       if(empty($cek1)){

         # 2.1. Tambah Tabel Penjualan
         self::tambahPenjualan($idPegawai,$idPelanggan,$waktu);

         # 2.2. Cek Diskon
         self::cekDiskonItem($barcode);
         self::cekDiskonMinimumItem($barcode,$qtyBeli);

         # perhitungan Diskon
         $diskonItem = (($tb_stok[0]->harga_jual * $this->persentaseDiskonItem) * $qtyBeli);
         if($diskonItem == 0){
           $diskonMinimumItem = (($tb_stok[0]->harga_jual * $this->persentaseDiskonMinimumItem) * $qtyBeli);
         }else if($diskonItem != 0){
           $hargaJualSetelahDiskonItem = $tb_stok[0]->harga_jual - ($tb_stok[0]->harga_jual * $this->persentaseDiskonItem);
           $diskonMinimumItem = ($hargaJualSetelahDiskonItem * $this->persentaseDiskonMinimumItem) * $qtyBeli;
         }

         $subtotal = (($qtyBeli * $tb_stok[0]->harga_jual) - $diskonItem) - $diskonMinimumItem;
         $nilaiDiskon = $diskonItem + $diskonMinimumItem;

         # 2.2. Tambah Tabel Transaksi
         self::tambahTransaksi($barcode,$qtyBeli,$subtotal,$nilaiDiskon);

         # 2.3 Tambah Tabel Transaksi Penjualan
         self::tambahTransaksiPenjualan($this->idTransaksi,$this->noPenjualan);

         # 2.4 Kurangi Stok
         self::kurangiStok($barcode,$tb_stok[0]->jumlah,$qtyBeli);



      //3. Jika Transaksi Penjualan Tidak Kosong
      }else if(!empty($cek1)){
        #cek no penjualan apakah masih penjualan  hari ini atau tidak
        $noPenjualan = $tbPenjualan[0]->no_penjualan;
        $waktuPenjualan = explode(" ",$tbPenjualan[0]->waktu);
        $tanggalPenjualan = $waktuPenjualan[0];


        if($tanggalPenjualan != $tglSekarang){
            #Tambah ke tabel Penjualan
            $tambahPenjualan = DB::table('tb_penjualan')
                       ->insertGetId([
                                   'id_pegawai'   => $idPegawai,
                                   'id_pelanggan' => $idPelanggan,
                                   'waktu'      => $waktu,
                                   'total'      => 0,
                                   'pajak'      => 0,
                                   'jenis_pembayaran' => 'tunai',
                                   'nominal_pembayaran' => 0
                                 ]);
            $noPenjualan = $tambahPenjualan;
        }

        # 3.1. Cek Diskon
        self::cekDiskonItem($barcode);
        self::cekDiskonMinimumItem($barcode,$qtyBeli);

        # 3.2. Perhitungan Diskon
        $diskonItem = (($tb_stok[0]->harga_jual * $this->persentaseDiskonItem) * $qtyBeli);
        if($diskonItem == 0){
          $diskonMinimumItem = (($tb_stok[0]->harga_jual * $this->persentaseDiskonMinimumItem) * $qtyBeli);
        }else if($diskonItem != 0){
          $hargaJualSetelahDiskonItem = $tb_stok[0]->harga_jual - ($tb_stok[0]->harga_jual * $this->persentaseDiskonItem);
          $diskonMinimumItem = ($hargaJualSetelahDiskonItem * $this->persentaseDiskonMinimumItem) * $qtyBeli;
        }
        $subtotal = (($qtyBeli * $tb_stok[0]->harga_jual) - $diskonItem) - $diskonMinimumItem;
        $nilaiDiskon = $diskonItem + $diskonMinimumItem;

        # Cek apakah ada transaksi di simpan
        if($cek1[0]->status == 'simpan'){
          # Tambah tabel Penjualan
          $tambahPenjualan2 = DB::table('tb_penjualan')
                     ->insertGetId([
                                 'id_pegawai'   => $idPegawai,
                                 'id_pelanggan' => $idPelanggan,
                                 'waktu'      => $waktu,
                                 'total'      => 0,
                                 'pajak'      => 0,
                                 'jenis_pembayaran' => 'tunai',
                                 'nominal_pembayaran' => 0
                               ]);
          $noPenjualan = $tambahPenjualan2;
        }

        # Cek untuk memproses transaksi di simpan
        $cekdummynopenjualan = DB::select('select * from dummy_simpan_no_penjualan
                                           order by no_penjualan desc limit 1');

        if(!empty($cekdummynopenjualan)){
          $noPenjualan = $cekdummynopenjualan[0]->no_penjualan;
        }

        # 3.3. Tambah Tabel Transaksi
        self::tambahTransaksi($barcode,$qtyBeli,$subtotal,$nilaiDiskon);

        # 3.4 Tambah Tabel Transaksi Penjualan
        self::tambahTransaksiPenjualan($this->idTransaksi,$noPenjualan);


        # 3.5 Kurangi Stok
        self::kurangiStok($barcode,$tb_stok[0]->jumlah,$qtyBeli);

        #3.6 Tambil Pemberitahuan Diskon
        $lihatDiskonMinimumItem = DB::table('tb_diskon_minimum_item')
                                     ->join('tb_induk_diskon_item','tb_diskon_minimum_item.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                                     ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                                     ->where('tb_stok.barcode','=',$barcode)
                                     ->where('tgl_berlaku','<=',$waktu)
                                     ->where('tgl_berakhir','>=',$waktu)
                                     ->get();

        $lihatDiskonItem = DB::table('tb_diskon_item')
                                     ->join('tb_induk_diskon_item','tb_diskon_item.id_induk_diskon_item','=','tb_induk_diskon_item.id_induk_diskon_item')
                                     ->join('tb_stok','tb_induk_diskon_item.barcode','=','tb_stok.barcode')
                                     ->where('tgl_berlaku','<=',$waktu)
                                     ->where('tgl_berakhir','>=',$waktu)
                                     ->get();
        return $arrayDiskon = array($lihatDiskonMinimumItem,$lihatDiskonItem);
     }



    }

    /*
    *  Fungsi untuk mengecek Diskon Item
    */
    public function cekDiskonItem($barcode)
    {
       $cekDiskon = DB::table('tb_diskon_item')
                     ->join('tb_induk_diskon_item','tb_diskon_item.id_induk_diskon_item','tb_induk_diskon_item.id_induk_diskon_item')
                     ->whereRaw('tgl_berlaku <= now() and tgl_berakhir >= now() and barcode = ?',$barcode)
                     ->get();

       if (count($cekDiskon)<= 0){
          $this->pemberitahuanDiskonItem = ' ';
          $this->persentaseDiskonItem = 0;
       }else if(count($cekDiskon)> 0){
          $this->persentaseDiskonItem = ($cekDiskon[0]->persentase / 100);
       }

    }

    /*
    *  Fungsi untuk mengecek Diskon Minimal Item
    */
    public function cekDiskonMinimumItem($barcode,$qtyBeli)
    {
      $cekDiskonMinimum = DB::table('tb_diskon_minimum_item')
                          ->join('tb_induk_diskon_item','tb_diskon_minimum_item.id_induk_diskon_item','tb_induk_diskon_item.id_induk_diskon_item')
                          ->whereRaw('tgl_berlaku <= now()
                                     and tgl_berakhir >= now()
                                     and barcode = '.$barcode.'
                                     and tb_diskon_minimum_item.qty_pembelian <='.$qtyBeli.'
                                     ')
                          ->get();
      // return $cekDiskonMinimum;

      if (count($cekDiskonMinimum)<= 0){
         $this->statusDiskonMinimumItem = 0;
         $this->pemberitahuanDiskonMinimumItem = ' ';
         $this->barcodeMinimumItem = $barcode;
         $this->qtyMinimum = 0;
      }else if(count($cekDiskonMinimum) > 0){
         $this->persentaseDiskonMinimumItem = $cekDiskonMinimum[0]->persentase / 100;
         $this->barcodeMinimumItem = $barcode;
         $this->qtyMinimum = $cekDiskonMinimum[0]->qty_pembelian;
      }
    }

    public function coba()
    {
      //  $cekDiskon = self::cekDiskonItem('089686010947');
      //  return $this->pemberitahuanDiskonItem.' '.$this->persentaseDiskonItem;

      // $cekDiskonMinimum = self::cekDiskonMinimumItem('8991002104914',3);
      // return $this->pemberitahuanDiskonMinimumItem.' '.$this->persentaseDiskonMinimumItem;
    }



    /*
    *  Tambah Penjualan
    */
    private function tambahPenjualan($idPegawai,$idPelanggan,$waktu)
    {
      $tb_penjualan = DB::table('tb_penjualan')
                          ->insertGetId([
                                  'id_pegawai'   => $idPegawai,
                                  'id_pelanggan' => $idPelanggan,
                                  'waktu'      => $waktu,
                                  'total'      => 0,
                                  'pajak'      => 0,
                                  'jenis_pembayaran' => 'tunai',
                                  'nominal_pembayaran' => 0
                        ]);
      $this->noPenjualan = $tb_penjualan;
    }

    /*
    *  Tambah Transaksi
    */
    private function tambahTransaksi($barcode,$qty,$subtotal,$nilaiDiskon)
    {
      $tb_transaksi = DB::table('tb_transaksi')
                      ->insertGetId(['barcode'  => $barcode,
                              'qty'      => $qty,
                              'subtotal' => $subtotal,
                              'nilai_diskon' => $nilaiDiskon,
                                    ]);
      $this->idTransaksi = $tb_transaksi;
    }

    /*
    *  Tambah Transaksi Penjualan
    */
    private function tambahTransaksiPenjualan($idTransaksi,$noPenjualan)
    {
      $tb_transaksi_penjualan = DB::table('tb_transaksi_penjualan')
                                  ->insert(['id_transaksi' => $idTransaksi,
                                            'no_penjualan' => $noPenjualan,
                                            'status'       => 'proses']);
    }

    private function kurangiStok($barcode,$jumlah,$qty)
    {
        $kurangStok = DB::table('tb_stok')
                          ->where('barcode','=',$barcode)
                          ->update(['jumlah' => $jumlah - $qty]);
    }


    public function cekDiskonAB($barcod,$qtyBeli,$idPenjualan)
    {

    }

    public function simpanTransaksi(Request $request){
        $noPenjualan = $request->noPenjualan;
        #1. update status tb_transaksi_penjualan menjadi simpan
        $update = DB::table('tb_transaksi_penjualan')
                      ->where('no_penjualan','=',$noPenjualan)
                      ->where('status','=','proses')
                      ->update(['status' => 'simpan']);

    }


}
