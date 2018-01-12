<?php

namespace App\Http\Controllers\Pemasok;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;

class PemasokController extends Controller
{
     public function showIndexTambahPemasok(){
        return view('pemasok.tambahPemasok.tambahPemasok');
     }
}
