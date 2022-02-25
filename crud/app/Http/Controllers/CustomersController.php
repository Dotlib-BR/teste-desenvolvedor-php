<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(){
        $data['customers'] = Customers::all();
        return view('customers.index', $data);
    }

    public function show($id){
        dd('customers.show', $id);
    }

    public function add(){
        return view('customers.add');
    }

    public function insert(Request $req){
        if($req -> has('name') && $req -> has ('cpf')){
            $name = $req -> input('name');
            $cpf = $req -> input('cpf');
            $email = $req -> input('email');
            $client = new Customers();
            $client -> name = $name;
            $client -> cpf = $cpf;
            $client -> email = $email;
            $client -> save();
            return redirect('/customers');
        }
    }

    public function edit($id){
        $client['customers'] = Customers::find($id);
        $data['id'] = $id;

        // $data['name'] = $client['name'];
        $data['cpf'] = $id;
        $data['email'] = $id;
        // return view('customers.edit', $data);
        dd('customers.edit', $client);
    }
}
