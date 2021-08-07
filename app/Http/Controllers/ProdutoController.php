<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('cruds.produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.produtos.create');
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
                'cd-barras' => 'string|max:20|unique:produtos,CodBarras',
                'valor' => 'required|numeric'
            ];
            $request->validate($validationRules);
            $produto = new Produto();
            $produto->NomeProduto = $request->input('nome');
            $produto->CodBarras = $request->input('cd-barras');
            $produto->Valor = $request->input('valor');
            $produto->save();

            return redirect()->route('produto.index')->with('success', "Produto criado com sucesso.");
        } catch (Exception $e) {
            return redirect()->route('produto.create')->with('error', $e->getMessage());
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
        $produto = Produto::find($id);
        return view('cruds.produtos.edit', ['produto' => $produto]);
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
            $produto = Produto::find($id);
            $validationRules = [
                'nome' => 'required|string',
                'cd-barras' => 'string|max:20|unique:produtos,CodBarras',
                'valor' => 'required|numeric'
            ];
            $request->validate($validationRules);
            $produto->NomeProduto = $request->input('nome');
            $produto->CodBarras = $request->input('cod-barras');
            $produto->Valor = $request->input('valor');
            $produto->save();

            return redirect()->route('produto.index')->with('success', "Produto atualizado com sucesso.");
        } catch (Exception $e) {
            return redirect()->route('produto.edit', $produto->id)->with('error', $e->getMessage());
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
            $produto = Produto::find($id);
            $produto->delete();
            return redirect()->route('produto.index')->with('success', "Produto apagado com sucesso.");
        }catch (\Exception $e){
            return redirect()->route('produto.index')->with('error', $e->getMessage());

        }
    }
}
