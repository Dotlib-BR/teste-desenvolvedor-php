<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientAddRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function all()
    {
        $clients = Clients::all();

        return response()->json($clients);
    }

    public function add(ClientAddRequest $request) 
    {
        if($request->validated()) {
            $client = new Clients();
            $client->name = $request->name;
            $client->email = $request->email;
            $client->date_birth = $request->date_birth;
            $client->cpf = $request->cpf;
            $client->phone = $request->phone;
            $client->stats = $request->stats;
            $client->cep = $request->cep;
            $client->address = $request->address;
            $client->complement = $request->complement;
            $client->city = $request->city;
            $client->sex = $request->sex;
            $client->save();

            return response()->json('success');
        }
    }

    public function show(Clients $client, Request $request)
    {
        return response()->json($client);
    }

    public function serchID(Clients $client, Request $request)
    {
        return response()->json($client);
    }

    public function update(Clients $client, ClientUpdateRequest $request)
    {
        if ($request->validated()) {
            $client->name = $request->name;
            $client->email = $request->email;
            $client->date_birth = $request->date_birth;
            $client->cpf = $request->cpf;
            $client->phone = $request->phone;
            $client->stats = $request->stats;
            $client->cep = $request->cep;
            $client->address = $request->address;
            $client->complement = $request->complement;
            $client->city = $request->city;
            $client->sex = $request->sex;
            $client->save();

            return response()->json('success');
        }
    }
    
    public function delete(Clients $client, Request $request) 
    {
        if ($client->delete()) {
            return response()->json('success');
        }
    }
}
