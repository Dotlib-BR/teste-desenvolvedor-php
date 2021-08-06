<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Cliente::all();
        return view('cruds.clientes.index', ['clientes' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validationRules = [
                'nome' => 'required|string',
                'cpf' => 'string|max:14|min:11|unique:clientes,CPF',
                'email' => 'required|email'
            ];
            $request->validate($validationRules);
            $cliente = new Cliente();
            $cliente->NomeCliente = $request->input('nome');
            $cliente->CPF = preg_replace('/\D/', '', $request->input('cpf'));
            $cliente->Email = $request->input('email');
            $cliente->save();

            return redirect()->route('cliente.index')->with('success', "Cliente criado com sucesso.");
        } catch (Exception $e) {
            return redirect()->route('cliente.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('cruds.clientes.edit', ['cliente' => $cliente]);
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
        try {
            $cliente = Cliente::find($id);
                $validationRules = [
                    'nome' => 'required|string',
                    'cpf' => 'numeric',
                    'email' => 'required|email'
                ];
                $request->validate($validationRules);
                $cliente->NomeCliente = $request->input('nome');
                $cliente->CPF = $request->input('cpf');
                $cliente->Email = $request->input('email');
                $cliente->save();

            return redirect()->route('cliente.index')->with('success', "Cliente atualizado com sucesso.");
        } catch (Exception $e) {
            return redirect()->route('cliente.edit', $cliente->id)->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cliente = Cliente::find($id);
            $cliente->delete();
            return redirect()->route('cliente.index')->with('success', "Cliente atualizado com sucesso.");
        }catch (\Exception $e){
            return redirect()->route('cliente.index')->with('error', $e->getMessage());

        }

    }
}
