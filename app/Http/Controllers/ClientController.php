<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Auth::user()
            ->clients()
            ->orderBy('name')
            ->paginate(20);
        
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.manage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request, Client $client)
    {
        $authUser = Auth::user();

        DB::transaction(function () use ($request, $client, $authUser) {
            $client->user()
                ->associate($authUser)
                ->fill($request->all())
                ->save();
        });

        return redirect()
            ->route('clients.create')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.manage', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientUpdateRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        DB::transaction(function () use ($request, $client) {
            $client->update($request->all());
        });

        return redirect()
            ->route('clients.edit', $client->id)
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        DB::transaction(function () use ($client) {
            $client->delete();
        });

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente removido com sucesso!');
    }

    /**
     * Filter clients
     *
     * @param  Request $request
     * @param  Client $client
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request, Client $client)
    {
        $page = $request->input('paged') ?? 20;
        $search = $request->input('search');
        $filters = $request->input('filter');
        $orderBy = $request->input('order');
        $sortBy = $request->input('sort');
        
        $query = $client->newQuery()
            ->where('user_id', Auth::user()->id);

        if ($filters) {
            if (in_array('name', $filters)) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
    
            if (in_array('email', $filters)) {
                $query->where('email', 'LIKE', '%' . $search . '%');
            }
            
            if (in_array('cpf', $filters)) {
                $query->where('cpf', 'LIKE', '%' . $search . '%');
            }
        }

        if ($orderBy && $sortBy) {
            $query->orderBy($orderBy, $sortBy);
        }

        $clients = $query->paginate($page)
            ->appends($request->except('page'));
        
        return view('client.index', compact('clients'));
    }
}
