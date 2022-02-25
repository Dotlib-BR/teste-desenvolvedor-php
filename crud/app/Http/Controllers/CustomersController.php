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
            return redirect('/customers')->with('msg', 'Cliente adicionada com sucesso!');
        }
    }
    public function edit($id){
        $client = Customers::findOrFail($id);
         return view('customers.edit', $client);
    }
    public function saveEdit(Request $req){
        Customers::findOrFail($req->id)->update($req->all());
        return redirect('/customers')->with('msg', 'Cliente editada com sucesso!');       
    }

    public function delet($id){
        Customers::findOrFail($id)->delete();
        return redirect('/customers')->with('msg', 'Cliente excluida com sucesso!');       

    }
}
