<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestsController extends Controller
{
    public function index(){

        return view('requests.index');
    }

    public function show($id){

        dd('users.show', $id);
    }
}
