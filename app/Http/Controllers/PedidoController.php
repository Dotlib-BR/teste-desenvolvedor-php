<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Support\Carbon;

class PedidoController extends Controller
{
    public function getAll()
    {
        $builder = Pedido::with(['cliente', 'produto']);

        if (request('sortBy') !== null) 
        {
            $direction = request('descending') === 'false' ? 'asc' : 'desc';
            $builder = $builder->orderBy(request('sortBy'), $direction);
        }

        $data = null;
        $total = 0;
        $qtdPages = intval(request('rowsPerPage'));

        if ($qtdPages > 0)
        {
            $paginator = $builder->paginate($qtdPages);
            $data = $paginator->getCollection();
            $total = $paginator->total();
        }
        else
        {
            $data = $builder->get();
            $total = $data->count();
        }

        return response()->json([
            'status' => 'ok',
            'result' => [
                'data' => $data,
                'total' => $total
                ]
        ]);
    }

    public function get($id)
    {
        $pedido = Pedido::with(['cliente', 'produto'])->find($id);
        return response()->json([
            'status' => 'ok',
            'result' => $pedido
        ]);        
    }

    public function delete($id)
    {
        $pedido = Pedido::with(['cliente', 'produto'])->find($id);
        $pedido->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'O pedido ' . $pedido->id . ' foi deletado com sucesso!',
            'result' => $pedido
        ]);
    }

    public function update($id)
    {
        $pedido = Pedido::with(['cliente', 'produto'])->find($id);
        $validator = validator(request()->all(),
            [
                'ClienteId' => 'nao_vazio|integer|cliente_existe',
                'ProdutoId' => 'nao_vazio|integer|produto_existe',
                'Quantidade' => 'nao_vazio|integer',
                'Status' => 'nao_vazio|in:-1,0,1'
            ],
            [
                'integer' => 'O campo :attribute deve ser um inteiro',
                'Status.in' => 'O campo Status possui valor inválido'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        if(request('ClienteId') !== null)
        {
            $pedido->cliente()->associate(intval(request('ClienteId')));
            $pedido->cliente; // força carregar o novo cliente no pedido
        }

        if(request('ProdutoId') !== null)
        {
            $pedido->produto()->associate(intval(request('ProdutoId')));
            $pedido->produto; // força carregar o novo produto no pedido
        }

        $pedido->update(request()->all());
        return response()->json([
            'status' => 'ok',
            'message' => 'O pedido ' . $pedido->id . ' foi editado com sucesso!',
            'result' => $pedido
        ]);
    }

    public function createNew()
    {
        $validator = validator(request()->all(),
            [
                'ClienteId' => 'required|integer|cliente_existe',
                'ProdutoId' => 'required|integer|produto_existe',
                'Quantidade' => 'required|integer',
                'Status' => 'required|in:-1,0,1'
            ],
            [
                'integer' => 'O campo :attribute deve ser um inteiro',
                'required' => 'O campo :attribute é obrigatório',
                'Status.in' => 'O campo Status possui valor inválido'
            ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => 'error',
                'result' => $validator->errors()
            ]);
        }

        $newPedido = new Pedido;
        $newPedido->fill(request()->all());
        $newPedido['DtPedido'] = Carbon::now();
        $newPedido->cliente()->associate(intval(request('ClienteId')));
        $newPedido->produto()->associate(intval(request('ProdutoId')));
        $newPedido->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'O pedido ' . $newPedido->id . ' foi criado com sucesso!',
            'result' => $newPedido
        ]);
    }

    public function deleteMultiple() 
    {
        $response = [];

        foreach (request('ids') as $id)
        {
            $pedido = Pedido::find(intval($id));

            if ($pedido)
            {
                $pedido->delete();
                $response[$id] = 'O pedido ' . $pedido->id . ' foi deletado com sucesso!';
            }
            else
            {
                $response[$id] = "Não existe um pedido com id " . $id . ".";
            }
        }
        return response()->json([
            'status' => 'ok',
            'result' => $response
        ]);
    }
}
