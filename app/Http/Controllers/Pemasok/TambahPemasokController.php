<?php

namespace App\Http\Controllers\Pemasok;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class TambahPemasokController extends Controller
{
      public function daftarPemasok()
      {
           return view('pemasok.tambahPemasok.daftarPemasok');
      }

      public function dataTablesPemasok()
      {
            $daftar = DB::connection('aditiyamart_inventory')
                                 ->table('tb_pemasok')
                                 ->get();

            return  Datatables::of($daftar)
                              //  ->addColumn('hapus',function($daftar){
                              //    return '<button  id="edit"
                              //            class="btn btn-info btn-xs" type="button"
                              //            name="button"
                              //            data-toggle="modal"
                              //            onclick="hapusBarang('.$daftar->nama_pemasok.')">
                              //            hapus
                              //            </button>';
                              //          })
                               ->addColumn('pilihan',function($daftar){
                                  return '<button  id="edit"
                                          class="btn
                                          btn-info btn-xs" type="button"
                                          name="button"
                                          data-toggle="modal"
                                          data-target="#modalEditPemasok"
                                          onclick="get_id('."'".$daftar->nama_pemasok."'".')">
                                          edit
                                          </button>';
                                        })
                               ->rawColumns(['pilihan','hapus'])
                               ->make(true);
      }

      public function tambahPemasok(Request $request)
      {
         $nama = $request->nama;
         $alamat = $request->alamat;
         $kota = $request->kota;
         $email = $request->email;
         $noTelpon = $request->noTelepon;
         $noHandphone = $request->noHandphone;

         if(empty($nama)){
           return "nama Kosong";
         }elseif(empty($alamat)){
           return "alamat Kosong";
         }elseif(empty($noHandphone)){
           return "noHandphone Kosong";
         }else{
           $tambahPemasok = DB::connection('aditiyamart_inventory')
                                ->table('tb_pemasok')
                                ->insert(['nama_pemasok' => $nama,
                                          'alamat' => $alamat,
                                          'kota' => $kota,
                                          'email' => $email,
                                          'no_Telpon' => $noTelpon,
                                          'no_Handphone' => $noHandphone,
                                        ]);

         }


        //  return $nama.' '.$alamat.' '.$kota.' '.$email.' '.$noTelpon.' '.$noHandphone;
      }

      public function get_id(Request $request)
      {
          $namaPemasok = $request->namaPemasok;
          $dataPemasok = DB::connection('aditiyamart_inventory')
                               ->table('tb_pemasok')
                               ->where('nama_pemasok','=',$namaPemasok)
                               ->get();
          return $dataPemasok;
      }

      public function editPemasok(Request $request)
      {
          $nama = $request->nama;
          $alamat = $request->alamat;
          $kota = $request->kota;
          $email = $request->email;
          $noTelepon = $request->noTelepon;
          $noHandphone = $request->noHandphone;

          $update = DB::connection('aditiyamart_inventory')
                               ->table('tb_pemasok')
                               ->where('nama_pemasok','=',$nama)
                               ->update(['alamat' => $alamat,
                                         'kota' => $kota,
                                         'email' => $email,
                                         'no_telpon' => $noTelepon,
                                         'no_handphone' => $noHandphone ]);
          // return $nama.' '.$alamat.' '.$kota.' '.$email.' '.$noTelepon.' '.$noHandphone;
      }
}
