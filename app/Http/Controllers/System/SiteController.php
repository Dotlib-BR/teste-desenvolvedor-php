<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class SiteController extends Controller
{

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    public function index()
    {
        $announcement = $this->announcement->with('company')->paginate(3);
        return view('site',compact('announcement'));
    }
}
