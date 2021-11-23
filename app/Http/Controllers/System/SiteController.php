<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;


class SiteController extends Controller
{
    public function index()
    {
        return view('site');
    }
}
