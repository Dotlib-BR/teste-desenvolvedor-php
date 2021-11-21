<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view('site');
    }
}
