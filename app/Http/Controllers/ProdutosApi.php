<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class ProdutosApi extends Controller

{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Produto::all();
    }

    public function autenticado()
    {
       
            // My code...
            return Produto::all();
        
    }

    public function autenticadoUnico(Request $request, $id){
       
        if($request->user()->tokenCan('ler')){
            return Produto::findorFail($id);
        }else{
            return 'acesso negado';
        }
      
    }
    public function autenticadoUpdate(Request $request, $id){
       
        if($request->user()->tokenCan('atualizar')){
            $validator = Validator::make($request->all(),[
                'nome_produto' => 'required|min:3',
                'slug' => 'required|alpha_dash|unique:produtos,slug,'.$id,
                'descricao' => 'required|min:5|max:5000',
                'valor_unitario' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'preco_promocional' =>'nullable|regex:/^\d+(\.\d{1,2})?$/',
                'sku' =>'required|max:20|unique:produtos,sku,'.$id, 
                'cod_barras' =>'required|numeric|digits_between:1,9|unique:produtos,cod_barras,'.$id,
                'imagem'  =>'mimes:jpeg,jpg,JPG,png,gif|max:20000',
                'categoria' =>'integer',
                'status_estoque' =>'required|in:disponivel,indisponivel',
                'quantidade_estoque'=>'integer|max:10000',
                'destaque' =>'integer|between:0,1|nullable'
    
            ]);
            if($validator->fails()) {
               
                
              return   response()->json(["mensagem" => 'Falha na atualização do produto.']);
            }
            
            
            $produto = Produto::find($id);
            
            if($produto){
                 
                    $produto->nome_produto = $request->get('nome_produto');
                    $produto->slug = $request->get('slug');
                    $produto->descricao = $request->get('descricao');
                    $produto->valor_unitario = $request->get('valor_unitario');
                    $produto->preco_promocional = $request->get('preco_promocional');
                    $produto->sku = $request->get('sku');
                    $produto->cod_barras = $request->get('cod_barras');
                    if($request->hasFile('imagem')){
                        $imagem_produto = $request->file('imagem');
                        $filename = time() . '.' . $imagem_produto->getClientOriginalExtension();
                        Image::make($imagem_produto)->resize(400, 400)->save( public_path('/imagens/fake_produtos/' . $filename ) );
                        $produto->imagem = $filename;
                    }
                    if($request->get('destaque') == null){
                        $destaquee = 0;
                    }else{
                        $destaquee = 1;
                    }
                    $produto->destaque = $destaquee;
                    
                    $categoria = Categoria::find($request->get('categoria'));
                    if($categoria){
                        $produto->categoria_id = $request->get('categoria');
                    }
                    $produto->status_estoque = $request->get('status_estoque');
                    $produto->quantidade_estoque = $request->get('quantidade_estoque');
                    $produto->save();
                    
                   
                    return 'Sucesso! Produto atualizado';
                    
               
                
            
            }else{
               return 'nenhum produto encontrado para atualizar';
            }
        }else{
            return 'acesso negado';
        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return Produto::findorFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
