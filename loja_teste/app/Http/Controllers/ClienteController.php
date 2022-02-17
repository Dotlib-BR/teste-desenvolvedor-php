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

    public function getClientByCPF(Request $request)
    {
        $client = Client::where('cpf', $request->cpf)->first();
        if($client)
            if($client->active)
                return $client;
            else 
                return "Cliente inativo";
        return "Cliente não existe";
    }

    public function getClientDetail($id)
    {
        $client = Client::findOrFail($id);
        if($client)
            if($client->active)
                return view("backend.client.detail", ['client' => $client]);
            else
                abort(403);
        else
            abort(404);
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
            abort(404);
    }

    public function postClientCreate(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|max:100|min:3',
            'cpf' => 'required|unique:clients|max:11|min:11',
            'email' => 'nullable|email|unique:clients',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->email = $request->email;
        $client->active = 1;
        $client->save();

        return redirect('/client/list');
    }

    public function putClientEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|min:3',
            'cpf' => 'required|max:11|min:11|unique:clients,cpf,'. $id,
            'email' => 'nullable|email|unique:clients,email,'.$id,
        ]);

        $client = Client::findOrFail($id);

        if($client)
        {
            $client->name = $request->name;
            $client->cpf = $request->cpf;
            $client->email = $request->email;
            $client->save();

            return redirect('/client/list');
        }
        else
            abort(404);
    }

    public function putClientDeactive($id)
    {
        $client = Client::findOrFail($id);
        if($client)
        {
            $client->active = 0;
            $client->save();

            return redirect('/client/list');
        }
        else
            abort(404);
    }
}
