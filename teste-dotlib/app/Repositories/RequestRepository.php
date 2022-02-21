<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use \App\Models\Request as Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RequestRepository
{
    public function __construct(){}

    public function store(Request $request) {
        if(!$request->get('client_id'))
            $request->merge(['client_id' => Session::get('user.id')]);

        $request->merge(['status_id' => 1]);
        $requestCreated = new Requests();
        $requestCreated->create($request->all());
        return $requestCreated;
    }

    public function getRequestByIdAjax($id) {
        $request = DB::table('requests as r')
                        ->join('requests_enum as re', 'r.status_id', '=', 're.id')
                        ->select('r.*', 're.status')
                        ->where('r.id', $id)->get()[0];
        return $request;
    }

    public function getRequestByUserIdAjax($id) {
//        $request = Requests::where('client_id', $id);
        $request = DB::table('requests as r')
                        ->join('requests_enum as re', 're.id', '=', 'r.status_id')
                        ->select('r.*', 're.status')
                        ->where('r.status_id', 1)
                        ->where('r.client_id', $id)->get();
        return $request;
    }

    public function listOrdersByRequest($id) {
        $request = DB::table('requests as re')
                        ->join('product_request as pr', 'pr.request_id', "=", 're.id')
                        ->join('products as prod', 'pr.product_id', "=", 'prod.id')
                        ->select('prod.name', 'pr.qtd', 'prod.unit_value')
                        ->where('pr.request_id', $id)->get();
        return $request;
    }

    public function destroyRequestByIdAjax($id) {
        $request = Requests::find($id);
        $request->delete();
        return $request;
    }

    public function addOrderInRequest(Request $request) {
        $product_request = new ProductRequest();
        $product_request->create($request->all());
        return $request->all();
    }
}
