<?php

namespace App\Http\Controllers\Api\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Tecnologia;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(){

        return response()->json(['tags' => Tecnologia::all()], 200);
    }
}
