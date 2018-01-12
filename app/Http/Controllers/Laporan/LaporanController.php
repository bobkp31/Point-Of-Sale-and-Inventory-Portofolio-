<?php

namespace App\Http\Controllers\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.laporan');
    }

    public function formHarian()
    {
        return view('laporan.formHarian');
    }

    public function formBulanan()
    {
        return view('laporan.formBulanan');
    }

}
