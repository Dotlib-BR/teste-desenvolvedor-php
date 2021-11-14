<?php


namespace App\Repository;


use App\Models\User;
use Illuminate\Database\QueryException;

class UsersRepository
{
    public function __construct(public User $model){}

    public function pesquisar($data, $coluna = 'id', $order = 'desc'){

        $termoBuscaAtual = session()->get('texto_busca') ? session()->get('texto_busca') : '';
        $termoBusca = isset($data['texto_busca']) ? $data['texto_busca'] : $termoBuscaAtual;

        try{
            $vagas = $this->model::where('id', $termoBusca)
                    ->orwhere('name', 'like','%'.$termoBusca.'%')
                    ->orwhere('last_name', 'like','%'.$termoBusca.'%')
                    ->orwhere('email', 'like','%'.$termoBusca.'%')
                    ->orderBy($coluna, $order)
                    ->paginate(20);

            return $vagas;
        }catch (\Exception $e){
            \Log::info($e);
            return [];
        }
    }

    public function getUser($id){
        try{
            return $this->model::find($id);
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getUsers($orderColuna, $paginacao = false){
        try{

            $coluna = $orderColuna ? : 'id';
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
