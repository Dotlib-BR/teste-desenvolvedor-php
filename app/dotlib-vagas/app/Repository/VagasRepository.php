<?php


namespace App\Repository;


use App\Models\AuxVagasUsers;
use App\Models\Vaga;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class VagasRepository
{
    public function __construct(public Vaga $model){}

    public function pesquisar($data, $coluna = 'vagas.id', $order = 'desc'){

        $termoBuscaAtual = session()->get('texto_busca') ? session()->get('texto_busca') : '';
        $termoBusca = isset($data['texto_busca']) ? $data['texto_busca'] : $termoBuscaAtual;

        try{
            $vagas = $this->model::select('vagas.*','tc.descricao as tipo_contratacao')
                    ->join('tipo_contratacao as tc', 'tc.id', '=', 'vagas.tipo_contratacao_id')
                    ->where('vagas.id', $termoBusca)
                    ->orwhere('titulo', 'like','%'.$termoBusca.'%')
                    ->orwhere('vagas.descricao', 'like','%'.$termoBusca.'%')
                    ->orwhere('alocacao', 'like','%'.$termoBusca.'%')
                    ->orwhere('tc.descricao', 'like','%'.$termoBusca.'%')
                    ->orwhere('salario', AppUtil::limpaValor($termoBusca))
                    ->orderBy($coluna, $order)
                    ->paginate(20);

            return $vagas;
        }catch (\Exception $e){
            \Log::info($e);
            return [];
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

            $coluna = $orderColuna ? : 'vagas.id';
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

            $data['salario'] = $data['salario'] ? AppUtil::limpaValor($data['salario']) : 0.0;

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
            DB::beginTransaction();
            $obj = $this->model::find($id);

            $inscricoes = AuxVagasUsers::where('vaga_id', $id)->get();

            foreach($inscricoes as $item){
                $item->delete();
            };

            $obj->delete();
            DB::commit();

            return true;
        }catch (QueryException $e){
            DB::rollBack();
            \Log::info($e);
            return false;
        }catch (\Exception $e){
            DB::rollBack();
            \Log::info($e);
            return false;
        }
    }

    public function pausarVaga($id){
        try{
            $obj = $this->model::find($id);
            $obj->pausada = true;
            $obj->save();

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
