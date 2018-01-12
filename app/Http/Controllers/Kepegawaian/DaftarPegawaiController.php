<?php

namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class DaftarPegawaiController extends Controller
{

    public function tabelPegawai()
    {
       return view('kepegawaian.daftarPegawai.daftarPegawai');
    }

    public function dataTablesPegawai()
    {
      $tb_pegawai = DB::connection('aditiyamart_kepegawaian')
                     ->table('tb_pegawai')
                     ->join('tb_jabatan','tb_pegawai.id_jabatan','=','tb_jabatan.id')
                     ->select('tb_pegawai.*','tb_jabatan.jabatan')
                     ->where('status_kepegawaian','=','Aktif')
                     ->get();

      return Datatables::of($tb_pegawai)
                          ->addColumn('hapus',function($tb_pegawai){
                            return '<button class="btn btn-info btn-xs" type="button"
                                            name="button"
                                            data-toggle="modal"
                                            onclick="hapusPegawai('.$tb_pegawai->id.')">
                                            hapus
                            </button>';
                          })
                         ->addColumn('pilihan',function($tb_pegawai){
                           return '<button  id="edit"
                                            class="btn
                                            btn-info btn-xs" type="button"
                                            name="button"
                                            data-toggle="modal"
                                            data-target="#modalEditPegawai"
                                            onclick="getIdPegawai('.$tb_pegawai->id.')">
                                          edit
                                    </button>';
                         })
                         ->rawColumns(['pilihan','hapus'])
                         ->make(true);
                        //->addColumn('pilihan','pos.pages.persedian.pilihan')
    }

    public function tambahPegawai(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $nip         = $request->nip;
        $namaPegawai = $request->namaPegawai;
        $jabatan     = $request->jabatan;
        $alamat      = $request->alamat;
        $tanggalLahir= $request->tanggalLahir;
        $status      = 'Aktif';

        $tambahPegawai = DB::connection('aditiyamart_kepegawaian')
                       ->table('tb_pegawai')->insert([
                            'nip'                => $nip,
                            'nama'       => $namaPegawai,
                            'id_jabatan'         => $jabatan,
                            'status_kepegawaian' => $status,
                            'alamat'             => $alamat,
                            'tgl_lahir'          => $tanggalLahir,
                            'created_at'          => $now,
                            'updated_at'          => $now
                         ]);


        return 'berhasil';
    }

    public function getIdPegawai(Request $request)
    {
        $id = $request->id;

        $tb_pegawai = DB::connection('aditiyamart_kepegawaian')
                          ->table('tb_pegawai')
                          ->join('tb_jabatan','tb_pegawai.id_jabatan','=','tb_jabatan.id')
                          ->where('tb_pegawai.id','=',$id)
                          ->where('status_kepegawaian','=','aktif')
                          ->get();

        return response()->json($tb_pegawai);
    }

    public function editPegawai(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $id  = $request->idPegawai;
        $nip = $request->nip;
        $namaPegawai = $request->namaPegawai;
        $jabatan = $request->jabatan;
        $alamat  = $request->alamat;
        $tanggalLahir  = $request->tanggalLahir;

        // return $jabatan;
        // // return $jabatan.' '.$alamat.' '.$tanggalLahir;
        $editPegawai = DB::connection('aditiyamart_kepegawaian')
                           ->table('tb_pegawai')
                           ->where('id',$id)
                           ->update(['nama'       => $namaPegawai,
                                     'id_jabatan' => $jabatan,
                                     'alamat'     => $alamat,
                                     'tgl_lahir'  => $tanggalLahir
                                    ]);

        // return 'berhasil';
    }

    public function hapusPegawai(Request $request)
    {
       $id = $request->id;
      //  return $id;
       $hapus = DB::connection('aditiyamart_kepegawaian')
                    ->table('tb_pegawai')
                    ->where('id',$id)
                    ->update(['status_kepegawaian' => 'berhenti']);
    }
}
