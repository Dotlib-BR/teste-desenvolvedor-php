<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function all(Request $response)
    {
        $clients = Clients::all();

        return response()->json($clients);
    }

    public function add(Request $request) 
    {
        $client = new Clients();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->date_birth = $request->date_birth;
        $client->cpf = $request->cpf;
        $client->phone = $request->phone;
        $client->stats = $request->stats;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->sex = $request->sex;
        $client->save();

        return response()->json('success');
    }

    public function delete(Clients $client, Request $request) 
    {
        $client->delete();

        return response()->json('success');
    }

    public function serchID(Clients $client, Request $request)
    {
        return response()->json($client);
    }

    public function update(Clients $client, Request $request)
    {
        $client->name = $request->name;
        $client->email = $request->email;
        $client->date_birth = $request->date_birth;
        $client->cpf = $request->cpf;
        $client->phone = $request->phone;
        $client->stats = $request->stats;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->sex = $request->sex;
        $client->save();

        return response()->json('success');
    }
    
}
