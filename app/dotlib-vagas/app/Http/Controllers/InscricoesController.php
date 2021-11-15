<?php

namespace App\Http\Controllers;

use App\Repository\InscricoesRepository;
use Illuminate\Http\Request;

class InscricoesController extends Controller
{

    public function __construct(public InscricoesRepository $inscricoesRepository){}

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

        $inscricoes = $this->inscricoesRepository->getInscricoes($request->order,$paginacao);

        return view('inscricoes.index')->with(compact('inscricoes'));
    }


    public function pesquisar(Request $request)
    {
        $data = $request->all();

        $request->session()->put('texto_busca',$data['texto_busca']);
        $request->session()->put('direcao_order',null);
        $request->session()->put('direcao_order_atual', null);

        $inscricoes = $this->inscricoesRepository->pesquisar($data);

        return view('inscricoes.index')->with(compact('inscricoes'));
    }

    public function inscricaoUserVaga($id)
    {
        $status = $this->inscricoesRepository->setInscricaoUser($id);

        if($status === 409){
            return response()->json([],409);
        }

        if(!$status){
            return response()->json([],400);
        }

        session()->flash('direcao_order',null);

        return response()->json([]);
    }

}
