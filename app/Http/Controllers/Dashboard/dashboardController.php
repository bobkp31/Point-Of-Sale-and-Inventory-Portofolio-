<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }
}
