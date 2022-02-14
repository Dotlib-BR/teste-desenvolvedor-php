<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientsController extends Controller
{
    public function show()
    {
        return Client::all();
    }

    public function store(Request $request)
    {

        $client = Client::create([
            'name' => $request->input('name'),
            'cpf' => $request->input('cpf'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $client;
    }

    public function getOne(Client $client)
    {

        return $client;
    }

    public function update(Request $request, Client $client)
    {

        $client->name = $request->input('name');
        $client->cpf = $request->input('cpf');
        $client->email = $request->input('email');
        $client->password = $request->input('password');
        $client->save();
        return $client;
    }

    public function delete(Client $client)
    {

        $client->delete();

        return response()->json(['success' => true]);
    }
}
