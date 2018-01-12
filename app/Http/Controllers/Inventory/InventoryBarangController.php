<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class InventoryBarangController extends Controller
{
    public function kotakDetailBarang()
    {
        return view('inventory.barang.kotakDetailBarang');
    }

    public function tambahKategori(Request $request)
    {
        $kategori = $request->kategori;

        if(empty($kategori)){
          return 'kosong';
        }if(!empty($kategori)){
          #1.Tambah ke database kategori
          DB::connection('aditiyamart_inventory')
              ->table('tb_kategori')->insert(['kategori'=>$kategori]);
          return 'ada';

        }

    }

    public function optionkategori()
    {
        $kategori = DB::connection('aditiyamart_inventory')
                        ->table('tb_kategori')
                        ->orderBy('kategori','asc')
                        ->get();
        return view('inventory.barang.optionKategori',['kategori'=>$kategori]);
    }

    public function tabelKategori()
    {
        $kategori = DB::connection('aditiyamart_inventory')
                        ->table('tb_kategori')
                        ->get();
        return view('inventory.barang.tabelKategori',['kategori'=>$kategori]);
    }


    public function formEditKategori(Request $request)
    {
        $idKategori = $request->id;
        $tabelKategori = DB::connection('aditiyamart_inventory')
                             ->table('tb_kategori')
                             ->where('id','=',$idKategori)
                             ->get();
        // return $idKategori;
        return view('inventory.barang.formEditKategori',['kategori' => $tabelKategori ]);
    }

    public function editKategori(Request $request)
    {
        $idKategori = $request->idKategori;
        $kategori = $request->kategori;

        if(empty($kategori)){
          return 'kosong';
        }elseif (!empty($kategori)){
          $editTabelKategori = DB::connection('aditiyamart_inventory')
                                  ->table('tb_kategori')
                                  ->where('id','=',$idKategori)
                                  ->update(['kategori' => $kategori]);
          return 'ok';
        }
    }

    public function tambahBarang(Request $request)
    {
        $barcode = $request->barcode;
        $namaBarang = $request->namaBarang;
        $kategori = $request->kategori;
        $hargaJual = $request->hargaJual;
        $pemasok = $request->pemasok;
        $persedianMinimum = $request->persedianMinimum;

        // return $barcode.' '.$namaBarang.' '.$kategori.' '.$hargaJual.' '.$pemasok.' '.$persedianMinimum;

        if(empty($barcode)){
          return 'barcode kosong';
        }else if(empty($namaBarang)){
          return 'nama barang kosong';
        }else if(empty($kategori)){
          return 'kategori kosong';
        }else if(empty($hargaJual)){
          return 'harga jual kosong';
        }else if(empty($persedianMinimum)){
          return 'persedian minimum kosong';
        }else{
          #Cek Nama yang sama
          $cekSama = DB::connection('aditiyamart_inventory')
                        ->table('tb_barang')
                        ->where('nama_barang','=',$namaBarang)
                        ->get();

          #jika tidak ada tambah semuanya
          if(count($cekSama) < 1){
            // return 'kosong';
            #Tambah Tabel barang
            $tambahBarang = DB::connection('aditiyamart_inventory')
                                ->table('tb_barang')
                                ->insertGetId(['kategori' => $kategori,
                                          'nama_barang'   => $namaBarang,
                                          'hpp'   => 0,
                                          'harga_jual'     => $hargaJual,
                                          'stok_tersedia' => 0,
                                          'stok_minimum' => $persedianMinimum,
                                          ]);

            #Tambah Tabel Barcode
            $tambahBarcode = DB::connection('aditiyamart_inventory')
                                ->table('tb_barcode')
                                ->insert(['id_barang' => $tambahBarang,
                                          'barcode'   => $barcode]);

            #Tambah Tabel tb_barang_pemasok
            $tambahBarangPemasok = DB::connection('aditiyamart_inventory')
                                 ->table('tb_barang_pemasok')
                                 ->insert(['id_barang' => $tambahBarang,
                                           'nama_pemasok' => $pemasok]);

          #jika ada, Tambah barcode saja dan update barang
          }else if(count($cekSama) >= 1){
            #Tambah tb_barcode
            $tambahBarcode = DB::connection('aditiyamart_inventory')
                                ->table('tb_barcode')
                                ->insert(['id_barang' => $cekSama[0]->id,
                                          'barcode'   => $pemasok]);

            #Tambah Tabel tb_barang_pemasok
            $tambahBarangPemasok = DB::connection('aditiyamart_inventory')
                                ->table('tb_barang_pemasok')
                                ->insert(['id_barang' => $cekSama[0]->id,
                                          'nama_pemasok' => $pemasok]);

          }

        }
        # Cek Hasil Masukan dari form tambah barang ( nanti di buatnya terakhir oky , selesaikan dulu yang penting)


    }

    public function dataTablesBarang()
    {
        $barang = DB::connection('aditiyamart_inventory')
                            ->table('tb_barang')
                            ->join('tb_barcode','tb_barang.id','=','tb_barcode.id_barang')
                            ->get();

         return  Datatables::of($barang)
                              // ->addColumn('hapus',function($barang){
                              //   return '<button  id="edit"
                              //   class="btn btn-info btn-xs" type="button"
                              //   name="button"
                              //   data-toggle="modal"
                              //   onclick="hapusBarang('.$barang->id.')">
                              //   hapus
                              //   </button>';
                              // })
                             ->addColumn('pilihan',function($barang){
                               return '<button  id="edit"
                                                class="btn
                                                btn-info btn-xs" type="button"
                                                name="button"
                                                data-toggle="modal"
                                                data-target="#modalEditBarang"
                                                onclick="get_id('.$barang->id.')">
                                              edit
                                        </button>';
                             })
                             ->rawColumns(['pilihan','hapus'])
                             ->make(true);
    }

    public function getBarang(Request $request)
    {
        $idBarang = $request->id;

        $barang = DB::connection('aditiyamart_inventory')
                      ->table('tb_barang')
                      ->join('tb_barcode','tb_barcode.id_barang','=','tb_barang.id')
                      // ->select('tb_barang.*','tb_barcode.barcode')
                      ->where('tb_barang.id','=',$idBarang)
                      ->get();
        return $barang;
    }

    public function editBarang(Request $request)
    {
        $idBarang = $request->id;
        $namaBarang = $request->namaBarang;
        $kategori = $request->kategori;
        $hpp = $request->hpp;
        $hargaJual = $request->hargaJual;
        $persedianMinimum = $request->persedianMinimum;

        $editBarang = DB::connection('aditiyamart_inventory')
                      ->table('tb_barang')
                      ->where('id','=',$idBarang)
                      ->update([
                                'kategori' => $kategori,
                                'nama_barang' => $namaBarang,
                                'hpp' => $hpp,
                                'harga_jual' => $hargaJual,
                                'stok_minimum' => $persedianMinimum
                              ]);
        // return $idBarang.' '.$barcode.' '.$namaBarang.' '.$kategori.' '.$hpp.' '.$hargaJual.' '.$persedianMinimum;
    }

    public function cetakSemua()
    {
      $cetakSemua = DB::connection('aditiyamart_inventory')
                        ->table('tb_barcode')
                        ->join('tb_barang','tb_barcode.id_barang','=','tb_barang.id')
                        ->get();
      // return $cetakSemua;
      return view('inventory.barang.cetakSemua',['barang' => $cetakSemua]);

    }



}
