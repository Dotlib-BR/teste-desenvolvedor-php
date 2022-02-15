<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClienteController extends Controller
{
    public function getClient()
    {
        $clients = Client::where('active', 1)->get();
        return view("backend.client.list", ['clients' => $clients]);
    }
    
    public function getClientCreate()
    {
        return view("backend.client.create");
    }

    public function getClientEdit($id)
    {
        $client = Client::findOrFail($id);

        if($client)
            return view("backend.client.edit", ['client' => $client]);
        else
            Abort(404);
    }

    public function postClientCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'cpf' => 'required|unique:clients|max:14|min:14',
            'email' => 'nullable|email|unique:clients',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->email = $request->email;
        $client->active = 1;

        $client->save();

        return redirect('/client');
    }

    public function putClientEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'cpf' => 'required|max:14|min:14|unique:clients,cpf,'. $id,
            'email' => 'nullable|email|unique:clients,email,'.$id,
        ]);

        $client = Client::findOrFail($id);

        if($client)
        {
            $client->name = $request->name;
            $client->cpf = $request->cpf;
            $client->email = $request->email;
            $client->save();

            return redirect('/client');
        }
        else
            Abort(404);
    }
}
