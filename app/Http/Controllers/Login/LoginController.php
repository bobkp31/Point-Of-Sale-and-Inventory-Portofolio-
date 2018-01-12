<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function cekLogin(Request $request)
    {
        # verifikasi username dan password
        $getUsername = $request->username;
        $getPassword = $request->password;

        $verifikasi = DB::connection('aditiyamart_kepegawaian')->table('tb_akun')
                       ->join('tb_pegawai','tb_akun.nip','=','tb_pegawai.nip')
                       ->select('tb_akun.*','tb_pegawai.nama')
                       ->where('username','=',$getUsername)
                       ->where('password','=',$getPassword)
                       ->where('status_kepegawaian','=','aktif')
                       ->get();

        // return $verifikasi;
        #cek isi verifikasi
        if(count($verifikasi) == 1){
          # set Session yang berisi username dan hak akses
          $request->session()->put('username',$verifikasi[0]->username);
          $request->session()->put('hak_akses',$verifikasi[0]->hak_akses);
          $request->session()->put('nip',$verifikasi[0]->nip);
          return 'success';
        }else if(count($verifikasi) != 1){
          return 'faild';
        }

    }

    public function berhasilLogin(Request $request){
        if(session('hak_akses') != 'Kasir'){
            return redirect('/dashboard');
        }else if(session('hak_akses') == 'Kasir'){
            #1.cek Setoran di tabel tb_kas_kasir
            $now = date('Y-m-d');
            $cekSetoran = DB::table('tb_kas_kasir')
                              ->whereRaw('date_format(waktu_setor,"%Y-%m-%d") = ?',$now)
                              ->where('username','=',session('username'))
                              ->get();

            // dd($cekSetoran);

            // return count($cekSetoran);
            #1.2 jika kosong arahkan ke input saldo awal
            if(count($cekSetoran) == 0){
                return redirect('/pos/penjualan/inputSaldoAwal');
            }else if(count($cekSetoran) == 1){
                return redirect('/pos/penjualan/index');
            }
        }
    }

    public function logOut(Request $request){
       $request->session()->flush();
       return redirect('/');
    }
}
