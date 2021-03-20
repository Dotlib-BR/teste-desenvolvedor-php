<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->expectsJson())
            return new ClientCollection(Client::with('orders')->get());

        return view("client.index", ["clients" => Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("client.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "string|required|max:100",
            "email" => "email|required|max:100|unique:clients",
            "cpf" => "string|required|max:11"
        ]);

        $client = Client::create($request->only("name", "email", "cpf"));

        if($request->expectsJson())
            return new ClientResource($client->with('orders')->first());

        return redirect()->route("client.index")->with("success","Cliente cadastrado!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Client $client)
    {
        if($request->expectsJson())
            return new ClientResource($client->with('orders')->first());

        return view("client.show", ["client" => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view("client.edit", ["client" => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            "name" => "string|required|max:100",
            "email" => "email|required|max:100|unique:clients,email,{$client->id}",
            "cpf" => "string|required|max:11"
        ]);

        $client->fill($request->only("name", "email", "cpf"));
        $client->save();

        if($request->expectsJson())
            return new ClientResource($client->with('orders')->first());

        return redirect()->route("client.index")->with("success","Cliente atualizado!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        if($request->expectsJson())
            return response()->json()->setStatusCode(204);

        return redirect()->route("client.index")->with("success","Cliente deletado!");
    }

    public function multDestroy(Request $request)
    {
        $request->validate([
            "clients_id" => "required|array"
        ]);

        Client::destroy($request->get("clients_id"));

        return redirect()->route("client.index")->with("success","Clientes deletados!");
    }
}
