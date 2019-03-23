<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $clients = Client::all();
        
        return response()->json($clients, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request, Client $client)
    {
        DB::transaction(function () use ($request, $client) {
            $user = User::find($request->input('user_id'));

            $client->user()
                ->associate($user)
                ->fill($request->all())
                ->save();

            $client->unsetRelation('user');
        });

        
        return response()->json($client, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        
        if ($client) {
            return response()->json($client, Response::HTTP_FOUND);
        }

        return response()->json([], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        DB::transaction(function () use ($request, $client) {
            $client->update($request->all());
        });

        return response()->json($client, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        DB::transaction(function () use ($client) {
            $client->delete();
        });

        return response()->json(true, Response::HTTP_OK);
    }
}
