<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Cliente;
use App\Models\Produto;
use Alert;
use Auth;

class SiteController extends Controller
{

    public function listaClientes()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $itensPorPagina = 20;

        $clientes = DB::table('clientes')->simplePaginate($itensPorPagina);

        return view('lista_clientes', compact('clientes','usuario_autenticado_nome'));
    }

    public function listaClientesOrderBy()
    {
        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $itensPorPagina = 20;

        $clientes = Cliente::sortable()->simplePaginate($itensPorPagina);

        return view('lista_clientes', compact('clientes','usuario_autenticado_nome'));
    }

    public function listaClientesPaginate(Request $request)
    {
     
        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $itensPorPagina = $request->input('itens_por_pagina');


        $clientes = Cliente::sortable()->simplePaginate($itensPorPagina, ['*']);


        return view('lista_clientes', compact('clientes','usuario_autenticado_nome'));
    }



    public function listaProdutos()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;

        $produtos = DB::table('produtos')->simplePaginate(20);

        return view('lista_produtos', compact('produtos','usuario_autenticado_nome'));
    }

    public function listaProdutosOrderBy()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $produtos = Produto::sortable()->simplePaginate(20);

        return view('lista_produtos', compact('produtos','usuario_autenticado_nome'));
    }

    public function listaProdutosPaginate(Request $request)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $itensPorPagina = $request->input('itens_por_pagina');


        $produtos = Produto::sortable()->simplePaginate($itensPorPagina, ['*']);


        return view('lista_produtos', compact('produtos','usuario_autenticado_nome'));
    }


    public function listaPedidos()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $clientes = DB::table('clientes')->get();
        $produtos = DB::table('produtos')->get();
        $pedidos = Pedido::with('cliente')->simplePaginate(20);

        return view('lista_pedidos', compact('pedidos', 'clientes', 'produtos','usuario_autenticado_nome'));
    }

    public function listaPedidosOrderBy()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $clientes = DB::table('clientes')->get();
        $produtos = DB::table('produtos')->get();
        $pedidos = Pedido::sortable()->with('cliente')->simplePaginate(20);

        return view('lista_pedidos', compact('produtos', 'clientes', 'pedidos','usuario_autenticado_nome'));
    }

    public function listaPedidosPaginate(Request $request)
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $itensPorPagina = $request->input('itens_por_pagina');


        $pedidos = Pedido::sortable()->simplePaginate($itensPorPagina, ['*']);


        return view('lista_pedidos', compact('pedidos','usuario_autenticado_nome'));
    }

    public function cadastroCliente()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        return view('cadastro_cliente', compact('usuario_autenticado_nome'));
    }

    public function cadastroProduto()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        return view('cadastro_produto', compact('usuario_autenticado_nome'));
    }

    public function cadastroPedidoCompra()
    {

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }

        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        $clientes = DB::table('clientes')->get();
        $produtos = DB::table('produtos')->get();


        return view('cadastro_pedido', compact('clientes', 'produtos','usuario_autenticado_nome'));
    }


    public function paginaLogin(){

        return view('pagina_login');

    }


    public function paginaCadastro(){

        return view('pagina_cadastro');

    }

    public function efetuarLoginUsuario(Request $request){

        $credentials = ['email' => $request->get('email') , 'password' => $request->get('password') ];


        if (Auth::attempt($credentials)){

            Alert::success('Bem-vindo', 'Login efetuado com sucesso!');


            return redirect()
            ->route('principal');

        }else{

            Alert::info('Erro', 'Verifique login e senha!');

            return redirect()
            ->route('pagina.login');

        }



    }


    public function paginaInicial(){

        if (!auth()->guard()
        ->user()) {
        return redirect('pagina.login');
    }
    
        $usuario_autenticado_nome = Auth::guard()->user()->nome;


        return view('principal', compact('usuario_autenticado_nome'));

    }


    public function efetuarLogout()
    {

        auth()
            ->guard()
            ->logout();

        return redirect('pagina.login');
    }


}
