<?php

namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class KepegawaianController extends Controller
{
    public function tampilDaftarPegawai()
    {
          $dbJabatan = DB::connection('aditiyamart_kepegawaian')
                            ->table('tb_jabatan')
                            ->get();

          return view('kepegawaian.daftarPegawai.pegawai',['tbJabatan' => $dbJabatan]);
    }

    public function tampilDaftarAkun()
    {
          // // return "hello";
          // $dbJabatan = DB::connection('aditiyamart_kepegawaian')
          //                   ->table('tb_jabatan')
          //                   ->get();
          //
          return view('kepegawaian.akun.akun');
    }
}
