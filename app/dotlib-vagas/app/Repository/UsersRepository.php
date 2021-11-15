<?php


namespace App\Repository;


use App\Models\AuxVagasUsers;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $data['password'] = Hash::make($data['password']);

            $this->model::create($data);
            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function update($id,$data){
        try{

            $obj =  $this->model::find($id);

            if(!$obj){
                return false;
            }

            unset($data['id']);

            if($data['password']){
                $data['password'] = Hash::make($data['password']);
            }else{
                unset($data['password']);
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
            $inscricoes = AuxVagasUsers::where('user_id', $id)->get();

            foreach($inscricoes as $item){
                $item->delete();
            };

            $obj = $this->model::find($id);
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
}
