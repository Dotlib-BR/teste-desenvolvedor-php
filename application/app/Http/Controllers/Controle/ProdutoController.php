<?php

namespace App\Http\Controllers\Controle;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Controle\ProdutoRequest;
use App\Services\ProdutoService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{

    protected $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->produtoService->paginate();

        return view('controle.produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('controle.produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $produto = $this->produtoService->create($input['nome'], (int) $input['cod_barras'], $input['valor'], null, $input['ativo'] ?? 0);

            DB::commit();
            return redirect()->route('controle.produtos.index')->with('msg', 'Registro cadastrado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back()->with('msg', "Erro ao cadastrar")->with('error', true)->withInput();
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
        $produto = $this->produtoService->find($id);

        return view('controle.produtos.create', ['produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();

        try {
            $produto = $this->produtoService->update($id, $input);

            DB::commit();

            return redirect()->route('controle.produtos.index')->with('msg', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            Log::error($e);

            return redirect()->back()->with('msg', "Erro ao cadastrar registro")->with('error', true)->withInput();
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
        try {

            $this->produtoService->delete($id);

            return redirect()->route('controle.produtos.index')->with('msg', 'Registro excluido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', "Erro ao excluir registro")->with('error', true);
        }
    }
}
