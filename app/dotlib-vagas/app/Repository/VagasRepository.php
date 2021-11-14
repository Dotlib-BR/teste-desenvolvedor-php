<?php


namespace App\Repository;


use App\Models\Vaga;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;

class VagasRepository
{

    public function __construct(public Vaga $model){}

    public function pesquisar($data){

        try{
            $vagas = $this->model::select('vagas.*','tc.descricao as tipo_contratacao')
                    ->join('tipo_contratacao as tc', 'tc.id', '=', 'vagas.tipo_contratacao_id')
                    ->where('vagas.id', $data['texto_busca'])
                    ->orwhere('titulo', 'like','%'.$data['texto_busca'].'%')
                    ->orwhere('vagas.descricao', 'like','%'.$data['texto_busca'].'%')
                    ->orwhere('alocacao', 'like','%'.$data['texto_busca'].'%')
                    ->orwhere('tc.descricao', 'like','%'.$data['texto_busca'].'%')
                    ->paginate(20);

            return $vagas;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getVaga($id){
        try{
            return $this->model::find($id);
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getListaVagas(){
        try{
            return $this->model::all();
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getVagas($orderColuna, $paginacao = false){
        try{

            $coluna = $orderColuna ? : 'created_at';
            $orderAtual =  session()->get('direcao_order_atual');
            $order = session()->get('direcao_order') ? session()->get('direcao_order') : ($orderAtual ?: 'desc');

            if($order && !$paginacao){
                $orderNew = $order == 'asc' ? 'desc' : ($order == 'desc' ? 'asc' : $order);

                session()->put('direcao_order_atual', $order);
                session()->put('direcao_order', $orderNew);
            }

            $order = $paginacao && $orderAtual ? $orderAtual : $order;

            return $this->model::select('vagas.*','tc.descricao as tipo_contratacao')
                                ->join('tipo_contratacao as tc', 'tc.id', '=', 'vagas.tipo_contratacao_id')
                                ->orderBy($coluna, $order)
                                ->paginate(20);

        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function store($data){
        try{
            $this->model::create($data);
            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function update($id,$data){
        try{
            unset($data['id']);

            $data['salario'] = AppUtil::limpaValor($data['salario']);

            $obj =  $this->model::find($id);

            if(!$obj){
                return false;
            }

            $obj->fill($data);
            $obj->save();

            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function delete($id){
        try{
            $obj = $this->model::find($id);
            $obj->delete();

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
