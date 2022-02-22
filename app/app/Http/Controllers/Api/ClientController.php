<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'per_page' => 'required|numeric',
        ]);

        return Client::paginate($request->input('per_page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'cpf' => 'unique:App\Models\Client,cpf|required|string|min:11|max:11',
            'email' => 'unique:App\Models\Client,email|required|email',
        ]);

        return Client::create($data);
    }

    /**
     * Display the specified resource.
     *New Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Client::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string',
            'cpf' => 'unique:App\Models\Client,cpf|string|min:11|max:11',
            'email' => 'unique:App\Models\Client,email|email',
        ]);

        return Client::findOrFail($id)
            ->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Client::destroy($id);
    }
}
