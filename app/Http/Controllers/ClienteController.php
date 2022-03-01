<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes= Cliente::get(); //recebe dados do bd
    
        return view('cliente', compact('clientes'));
       
    }

    public function store(Request $request)
    {
        $dados = new Cliente;

        $dados->NomeCliente = $request->nomeCliente;
        $dados->CPF = $request->cpfCliente;
        $dados->Email = $request->emailCliente;
        $dados->save(); // salva os dados do formulario no banco

        return redirect('/cadastrarCliente');

    }

    public function show($id){
        $cliente = Cliente::findOrFail( $id );
        return view('detalhesDoCliente', compact('cliente'));
      }

      public function showPedido($id){
        $cliente = Cliente::findOrFail( $id );
        return view('detalhesCliente', compact('cliente'));
      }

    public function showEdit($id){
        $cliente = Cliente::findOrFail( $id );
        return view('editarCliente', compact('cliente'));
      }

    public function update(Request $request){
        $cliente = Cliente::findOrFail( $request->id );
        $cliente->NomeCliente = $request->nomeCliente;
        $cliente->CPF = $request->cpfCliente;
        $cliente->Email = $request->emailCliente;
    
        if( $cliente->save() ){
            return redirect('/api/cliente');
        }
      } 

    public function destroy($id){
        $cliente = Cliente::findOrFail( $id );
        if( $cliente->delete() ){
            return redirect('/api/cliente');
        }
    
      }


}
