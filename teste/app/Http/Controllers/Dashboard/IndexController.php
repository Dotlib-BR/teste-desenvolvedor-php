<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function home()
    {
        return view('dashboard.home');
    }
}
