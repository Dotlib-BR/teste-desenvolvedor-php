<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Web extends Controller
{
    public function home()
    {
        return view('home',[
            "title" => "Home"
        ]);
    }

    public function clients()
    {
        return view('clients',[
            "title" => "Clientes",
            "clients" => Client::orderBy('name','asc')->paginate(20),
            "teste" =>"teeeeste"
        ]);
    }

    public function filterClients($filter)
    {
        $clients = '';

        if($filter == 'name' || $filter == 'cpf' ||$filter == 'email'){
            $clients = Client::orderBy($filter,'asc')->paginate(20);
        }else{
            return redirect()->route('web.clients');
        }
        
        return view('clients',[
            "title" => "Clientes",
            "clients" => $clients
        ]);
    }

    public function products()
    {
        return view('products',[
            "title" => "Produtos",
            "products" => Product::orderBy('name','asc')->paginate(20)
        ]);
    }

    public function filterProducts($filter)
    {
        $products = '';

        if($filter == 'bar_code' || $filter == 'name' ||$filter == 'price'){
            $products = Product::orderBy($filter,'asc')->paginate(20);
        }else{
            return redirect()->route('web.products');
        }
        
        return view('products',[
            "title" => "Produtos",
            "products" => $products
        ]);
    }

    public function orders()
    {
        return view('orders',[
            "title" => "Pedidos",
            "orders" => Order::orderBy('id','asc')->paginate(20)
        ]);
    }

    public function filterOrders($filter)
    {
        $orders = '';

        if($filter == 'id' || $filter == 'client_id' || $filter == 'product_id' || $filter == 'amount'){
            $orders = Order::orderBy($filter,'asc')->paginate(20);
        }else{
            return redirect()->route('web.orders');
        }
        
        return view('orders',[
            "title" => "Pedidos",
            "orders" => $orders
        ]);
    }

    public function edit($table, $id)
    {
        $search = '';
        $routePart = '';

        if($table == 'pedido'){
            $search = Order::find($id)->toArray();
            $routePart = "order";
        }

        if($table == 'cliente'){
            $search = Client::find($id)->toArray();
            $routePart = "client";
        }

        if($table == 'produto'){
            $search = Product::find($id)->toArray();
            $routePart = "product";
        }

        return view('edit',[
            "title" => "Editar",
            "table" => $table,
            "id" => $id,
            "search" => $search,
            "routePart" => $routePart
        ]);
    }

    public function create($table)
    {   
        $search = '';
        $routePart = '';

        if($table == 'pedido'){
            $search = Order::all()->random()->first()->toArray();
            $routePart = "order";
        }

        if($table == 'cliente'){
            $search = Client::all()->random()->first()->toArray();
            $routePart = "client";
        }

        if($table == 'produto'){
            $search = Product::all()->random()->first()->toArray();
            $routePart = "product";
        }

        return view('create',[
            "title" => 'Novo',
            "search" => $search,
            "table" => $table,
            "routePart" => $routePart
        ]);
    }

    public function view($table, $id)
    {   
        $search = '';
        $routePart = '';

        if($table == 'pedido'){
            $search = Order::find($id)->toArray();
            $routePart = "order";
        }

        if($table == 'cliente'){
            $search = Client::find($id)->toArray();
            $routePart = "client";
        }

        if($table == 'produto'){
            $search = Product::find($id)->toArray();
            $routePart = "product";
        }
        //dd( $search );
        return view('view',[
            "title" => 'Novo',
            "search" => $search,
            "table" => $table,
            "routePart" => $routePart
        ]);
    }

    public function teste($nome)
    { 
        return view('teste',[
            "nome" => $nome
        ]);
    }
}
