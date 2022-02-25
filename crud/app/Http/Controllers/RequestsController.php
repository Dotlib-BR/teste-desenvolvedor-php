<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use App\Models\OperationType;
use App\Models\Sales;
use App\Models\Products;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class RequestsController extends Controller
{
    public function index(){
        $data['requests'] = Requests::all();
        return view('requests.index', $data);
    }

    public function addType(){
        return view('requests.type');
    }public function insertType(Request $req){
        if($req -> has('type')){
            $typeStatus = $req -> input('type');
            $type = new OperationType();
            $type -> type = $typeStatus;
            $type -> save();
            return redirect('/requests')->with('msg','Tipo ' . $typeStatus . ' criado com sucesso!');
        }
    }

    public function add(){
        return view('requests.add');
    }
    public function insert(request $req){
        if($req -> has('id_customer') ){

            $now = new DateTime();
            $datetime = $now->format('Y-m-d H:i:s'); 
            $id_customer = $req -> input('id_customer');
            $id_state = $req -> input('id_state');
            $newRequest = new Request();
            $newRequest -> dt_request = $datetime;
            $newRequest -> id_customer = $id_customer;
            $newRequest -> id_state = $id_state;
            $newRequest -> save();

            $number_request = $req  ;
            $id_product = $req -> input('id_product');
            $newSales = new Request();
            $newSales -> number_request = $number_request;
            $newSales -> id_product = $id_product;
            $newSales -> save();

            return redirect('/products')->with('msg', 'Pedido adicionado com sucesso!');
        }
    }


}
