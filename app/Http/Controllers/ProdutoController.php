<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Image;
use App\Models\Voucher;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produtos = Produto::all();
        
        return view('admin.produto')->with(compact('produtos'));
    }

    public function apiDoc(){

        return view('doc.api');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
            return view('admin.forms.form-produto');
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
        $validator = Validator::make($request->all(),[
            'nome_produto' => 'required|min:3',
            'slug' => 'required|alpha_dash|unique:produtos,slug',
            'descricao' => 'required|min:5|max:5000',
            'valor_unitario' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'preco_promocional' =>'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'sku' =>'required|max:20|unique:produtos,sku', 
            'cod_barras' =>'required|numeric|digits_between:1,9|unique:produtos,cod_barras',
            'imagem'  =>'mimes:jpeg,jpg,JPG,png,gif|max:20000',
            'categoria' =>'integer',
            'status_estoque' =>'required|in:disponivel,indisponivel',
            'quantidade_estoque'=>'integer|max:10000',
            'destaque' =>'integer|between:0,1|nullable'

        ]);
        if($validator->fails()) {
            //Erro desconhecido no redirect - Código alternativo abaixo
           // notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
            //return Redirect::back()->withErrors($validator)->with('autofocus', true);
           //gambi 
            notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
            return view('admin.forms.form-produto')->withErrors($validator)->with('autofocus', true);
            //endgambi
        }
       
                $produto = new Produto();
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
                }else{
                    $produto->imagem = 'indisponivel.png';
                }
                if($request->get('destaque') === null){
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
                
               // notify()->success('Produto criado com Sucesso!','Sucesso');
               // return Redirect::back();

                notify()->success('Produto criado com Sucesso!','Sucesso');
                return view('admin.forms.form-produto');
          
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $produto = Produto::where('slug','=',$slug)->first();
        if($produto){
            
            return view('admin.produto-detalhado')->with(compact('produto'));
        }else{
            return redirect()->route('adminDashboard');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $produto = Produto::find($id);
        if($produto){
            $encryptado = Crypt::encryptString($produto->id);
            return view('admin.forms.form-produto')->with(compact('produto','encryptado'));
        }else{
            return redirect()->route('adminDashboard');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            //Erro no redirect - Código alternativo abaixo
            //notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
            //return Redirect::back()->withErrors($validator)->with('autofocus', true);
            //gambi
            $produto = Produto::find($id);
            if($produto){
                $encryptado = Crypt::encryptString($produto->id);
                notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
                return view('admin.forms.form-produto')->with(compact('produto','encryptado'))->withErrors($validator)->with('autofocus', true);
            }else{
                return redirect()->route('adminDashboard');
            }
            //endgambi

        }
        $decryptado= Crypt::decryptString($request->seguro);
        $decryptado = (int)$decryptado;
        
        $produto = Produto::find($id);
        
        if($produto){
            if($produto->id === $decryptado){
                
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
                //original
                //notify()->success('Alterações realizadas com Sucesso!','Sucesso');
                //return Redirect::back();
          //gambi
                notify()->success('Alterações realizadas com Sucesso!','Sucesso');
                return view('admin.forms.form-produto');
          //endgambi
                
                
            }else{
              //  notify()->error('O sistema detectou uma violação de rota. Por segurança a requisição foi cancelada!');
               // return Redirect::back()->withErrors($validator)->with('autofocus', true);
               $produto = Produto::find($id);
               if($produto){
                   $encryptado = Crypt::encryptString($produto->id);
                   notify()->error('O sistema detectou uma violação de rota. Por segurança a requisição foi cancelada!');
                   return view('admin.forms.form-produto')->withErrors($validator)->with(compact('produto','encryptado'));
                 
               }else{
                   return redirect()->route('adminDashboard');
               }
            }
            
        
        }else{
            notify()->error('Nenhum produto encontrado para edição. Crie um novo produto');
            redirect()->route('produtos.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
    }

 
    public function cuponsLista()
    {
        //
        $produtos = Produto::all();
        $cupons = Voucher::all();
        $unique = $cupons->unique('model_id');
        $cuponResgatados = \DB::table('user_voucher')->get();
        return view('admin.cupons-lista')->with(compact('produtos','cupons','unique','cuponResgatados'));
      
    }
    public function cuponsCreate()
    {
        //
        $produtos = Produto::all();
        
        return view('admin.forms.form-cupom')->with(compact('produtos'));
      
    }
    public function cupons($produto_id)
    {
        //
       
    }
    public function cupomStore(Request $request)
    {
        //
     

        $validator = Validator::make($request->all(),[
            'porcentagem_cupom' => 'required|integer|max:100',
            'quantidade_cupom' =>'required|integer|max:100', 
            'produto_cupom'=>'integer|max:10000',
            'condicao_cupom' =>'integer|between:0,1'

        ]);
        if($validator->fails()) {
         //   notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
          //  return Redirect::back()->withErrors($validator)->with('autofocus', true);
          $produtos = Produto::all();
          notify()->error('Não foi possível atualizar seu produto. Alguns erros foram encontrados. Confira os campos digitados ⚡️', 'Falha');
          return view('admin.forms.form-cupom')->withErrors($validator)->with(compact('produtos'));
        }
        $produto = Produto::find($request->get('produto_cupom'));
        if($produto){
            $quantidade = $request->get('quantidade_cupom');
            $porcentagem = $request->get('porcentagem_cupom');
            $condicao = $request->get('condicao_cupom');
            $voucher = $produto->createVouchers($quantidade, [
                'desconto_porcentagem' =>$porcentagem ,
                'condicao_cupom' => $condicao
            ]);
                //notify()->success('Cupom criado com sucesso!','Sucesso');
               // return Redirect::back();
                $produtos = Produto::all();
                notify()->success('Cupom criado com sucesso!','Sucesso');
                return view('admin.forms.form-cupom')->with(compact('produtos'));
        }else{
            //notify()->error('Produto não localizado ⚡️', 'Falha');
            //return Redirect::back()->withErrors($validator)->with('autofocus', true);
            $produtos = Produto::all();
            return view('admin.forms.form-cupom')->withErrors($validator)->with(compact('produtos'));
        }
       
    }
    
}
