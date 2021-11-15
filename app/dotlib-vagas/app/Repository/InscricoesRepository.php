<?php


namespace App\Repository;


use App\Models\AuxVagasUsers;
use App\Models\Vaga;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class InscricoesRepository
{

    public function __construct(public Vaga $model){}

    public function pesquisar($data, $coluna = 'avu.id', $order = 'desc'){

        $termoBuscaAtual = session()->get('texto_busca') ? session()->get('texto_busca') : '';
        $termoBusca = isset($data['texto_busca']) ? $data['texto_busca'] : $termoBuscaAtual;

        try{
            $vagas = $this->model::select('vagas.*','tc.descricao as tipo_contratacao','u.name','u.email')
                    ->join('tipo_contratacao as tc', 'tc.id', '=', 'vagas.tipo_contratacao_id')
                    ->join('aux_vagas_users as avu', 'avu.vaga_id', '=', 'vagas.id')
                    ->join('users as u', 'u.id', '=', 'avu.user_id')
                    ->where('vagas.id', $termoBusca)
                    ->orwhere('u.id', $termoBusca)
                    ->orwhere('u.name', 'like','%'.$termoBusca.'%')
                    ->orwhere('u.email', 'like','%'.$termoBusca.'%')
                    ->orwhere('titulo', 'like','%'.$termoBusca.'%')
                    ->orwhere('vagas.descricao', 'like','%'.$termoBusca.'%')
                    ->orwhere('alocacao', 'like','%'.$termoBusca.'%')
                    ->orwhere('tc.descricao', 'like','%'.$termoBusca.'%')
                    ->orderBy($coluna, $order)
                    ->paginate(20);

            return $vagas;
        }catch (\Exception $e){
            \Log::info($e);
            return [];
        }
    }

    public function getInscricoes($orderColuna, $paginacao = false){
        try{

            $coluna = $orderColuna ? : 'avu.id';
            $orderAtual =  session()->get('direcao_order_atual');
            $order = session()->get('direcao_order') ? session()->get('direcao_order') : ($orderAtual ?: 'desc');

            if($order && !$paginacao){
                $orderNew = $order == 'asc' ? 'desc' : ($order == 'desc' ? 'asc' : $order);

                session()->put('direcao_order_atual', $order);
                session()->put('direcao_order', $orderNew);
            }

            $order = $paginacao && $orderAtual ? $orderAtual : $order;

            return $this->pesquisar(null, $coluna, $order);

        }catch (\Exception $e){
            \Log::info($e);
            return [];
        }
    }

    public function setInscricaoUser($idVaga){
        try{
            $obj = AuxVagasUsers::where('user_id', Auth::user()->id)
                                ->where('vaga_id', $idVaga)
                                ->count();
            if ($obj)
                return 409;

            AuxVagasUsers::create(['user_id'=> Auth::user()->id,'vaga_id'=> $idVaga]);
            return true;
        }catch (QueryException $e){
            \Log::info($e);
            return false;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }
}
