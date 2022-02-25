<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $data['products'] = Products::all();
        return view('products.index', $data);
    }

    public function add(){
        return view('products.add');
    }
    public function insert(Request $req){
        if($req -> has('product') ){
            $product = $req -> input('product');
            $bar_code = $req -> input('bar_code');
            $inventory = $req -> input('inventory');
            $value = $req -> input('value');
            $description = $req -> input('description');
            $inProduct = new Products();
            $inProduct -> product = $product;
            $inProduct -> bar_code = $bar_code;
            $inProduct -> inventory = $inventory;
            $inProduct -> value = $value;
            $inProduct -> description = $description;
            $inProduct -> save();
            return redirect('/products')->with('msg', 'Produto adicionado com sucesso!');
        }
    }
    public function edit($id){
        $inProduct = Products::findOrFail($id);
         return view('products.edit', $inProduct);
    }
    public function saveEdit(Request $req){
        Products::findOrFail($req->id)->update($req->all());
        return redirect('/products')->with('msg', 'Produto editada com sucesso!');       
    }

    public function delet($id){
        Products::findOrFail($id)->delete();
        return redirect('/products')->with('msg', 'Produto excluida com sucesso!');       

    }

}
