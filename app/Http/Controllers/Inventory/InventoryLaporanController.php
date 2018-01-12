<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InventoryLaporanController extends Controller
{
     public function indexLaporan()
     {
         return view('inventory.laporan.laporanArsip');
     }
}
