<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Announcement;

class DashboardController extends Controller
{
    private $usersTotal;
    private $announcementsTotal;
    private $companiesTotal;

    public function __construct(User $user, Company $company, Announcement $announcement)
    {
        $this->usersTotal = $user;
        $this->announcementsTotal = $announcement;
        $this->companiesTotal = $company ;
    }

    public function index()
    {
        $title = "Tela Inicial";
        $description = 'Dashboard';
        $companiesTotal =  $this->companiesTotal->get()->count();
        $announcementsTotal =  $this->announcementsTotal->get()->count();
        $usersTotal = $this->usersTotal->orWhere('user','=','1')->orWhere('admin','=','1')->get()->count();
        return view('dashboard.index', compact('title','usersTotal','companiesTotal', 'announcementsTotal', 'description'));
    }
}
