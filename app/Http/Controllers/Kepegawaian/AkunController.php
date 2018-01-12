<?php
namespace App\Http\Controllers\Kepegawaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class AkunController extends Controller
{
    public function tabelAkun()
    {
       return view('kepegawaian.akun.daftarAkun');
    }

    public function dataTablesAkun()
    {
      $tb_akun = DB::connection('aditiyamart_kepegawaian')
                     ->table('tb_akun')
                     ->join('tb_pegawai','tb_akun.nip','=','tb_pegawai.nip')
                     ->select('tb_akun.*','tb_pegawai.nama')
                     ->where('status','=','Aktif')
                     ->get();

      return Datatables::of($tb_akun)
                          ->addColumn('hapus',function($tb_akun){
                            return '<button class="btn btn-warning btn-xs" type="button"
                                            name="button"
                                            data-toggle="modal"
                                            onclick="hapusAkun('.$tb_akun->id.')">
                                            hapus
                            </button>';
                          })
                         ->addColumn('pilihan',function($tb_akun){
                           return '<button  id="edit"
                                            class="btn btn-warning btn-xs"
                                            type="button"
                                            name="button"
                                            data-toggle="modal"
                                            data-target="#modalEditAkun"
                                            onclick="getIdAkun('.$tb_akun->id.')">
                                          edit
                                    </button>';
                         })
                         ->rawColumns(['pilihan','hapus'])
                         ->make(true);
                        //->addColumn('pilihan','pos.pages.persedian.pilihan')
    }

    public function tambahAkun(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $nip         = $request->nip;
        $username    = $request->username;
        $password    = $request->password;
        $hakAkses    = $request->hakAkses;

        $tambahAkun = DB::connection('aditiyamart_kepegawaian')
                       ->table('tb_akun')->insert([
                            'nip'        => $nip,
                            'username'   => $username,
                            'password'   => $password,
                            'hak_akses'  => $hakAkses,
                            'created_at' => $now,
                            'updated_at' => $now
                         ]);


        return $now.' '.$nip.' '.$username.' '.$password.' '.$hakAkses;
    }

    public function getIdAkun(Request $request)
    {
        $id = $request->id;
        $tb_akun = DB::connection('aditiyamart_kepegawaian')
                       ->table('tb_akun')
                       ->join('tb_pegawai','tb_akun.nip','=','tb_pegawai.nip')
                       ->select('tb_akun.*','tb_pegawai.nama')
                       ->where('tb_akun.id','=',$id)
                       ->get();

        return response()->json($tb_akun);
    }

    public function editAkun(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $id  = $request->idPegawai;
        $nip = $request->nip;
        $username = $request->username;
        $password = $request->password;
        $hakAkses = $request->hakAkses;

        $editPegawai = DB::connection('aditiyamart_kepegawaian')
                           ->table('tb_akun')
                           ->where('id',$id)
                           ->update(['username'  => $username,
                                     'password'  => $password,
                                     'hak_akses' => $hakAkses,
                                     'updated_at'=> $now
                                   ]);

    }

    public function hapusAkun(Request $request)
    {
       $id = $request->id;
      //  return $id;
       $hapus = DB::connection('aditiyamart_kepegawaian')
                    ->table('tb_akun')
                    ->where('id',$id)
                    ->update(['status' => 'di hapus']);
    }
}
