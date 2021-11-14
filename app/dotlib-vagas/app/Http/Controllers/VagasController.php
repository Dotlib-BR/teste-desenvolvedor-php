<?php

namespace App\Http\Controllers;

use App\Http\Requests\VagaRequest;
use App\Repository\TipoContratacaoRepository;
use App\Repository\VagasRepository;
use Illuminate\Http\Request;

class VagasController extends Controller
{

    public function __construct(public VagasRepository $vagasRepository,
                                public TipoContratacaoRepository $tipoContratacaoRepository){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginacao = isset($request->page);


        if (!$request->order){
            $request->session()->forget('texto_busca');
            $request->session()->forget('direcao_order');
            $request->session()->forget('direcao_order_atual');
        }

        $vagas = $this->vagasRepository->getVagas($request->order,$paginacao);

        return view('vagas.index')->with(compact('vagas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoContratacaoLista = $this->tipoContratacaoRepository->getListaTipoContratacao();

        return view('vagas.cadastrar')->with(compact('tipoContratacaoLista'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\VagaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VagaRequest $request)
    {
        $data = $request->all();
        $status = $this->vagasRepository->store($data);

        if(!$status){
            $request->session()->flash('error',"Error ao salvar o registro");
            $vaga = $data;
            return view('vagas.cadastrar')->with(compact('vaga'));
        }

        return redirect('vagas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vaga = $this->vagasRepository->getVaga($id);
        $tipoContratacaoLista = $this->tipoContratacaoRepository->getListaTipoContratacao();

        return view('vagas.cadastrar')->with(compact('vaga','tipoContratacaoLista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VagaRequest $request, $id)
    {
        $data = $request->all();

        $status = $this->vagasRepository->update($id,$data);

        if(!$status){
            \Log::info('error');
            $request->session()->flash('error',"Error ao atualizar o registro");
            $vaga = $data;

          return view('vagas.cadastrar')->with(compact('vaga'));
        }

        return redirect('vagas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->vagasRepository->delete($id);

        if(!$status){
            return response()->json([],400);
        }

        session()->flash('direcao_order',null);

        return $status;
    }

    public function pesquisar(Request $request)
    {
        $data = $request->all();

        $request->session()->put('texto_busca',$data['texto_busca']);
        $request->session()->put('direcao_order',null);
        $request->session()->put('direcao_order_atual', null);

        $vagas = $this->vagasRepository->pesquisar($data);

        return view('vagas.index')->with(compact('vagas'));
    }
}
