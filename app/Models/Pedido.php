<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'codBarras',
        'dataPedido',
        'status',
        'idCliente',
        'valorTotal'
    ];

    public function rules(){
        $rules = [
            'idCliente' => 'required'
        ];

        return $rules;
    }

    public function messages(){
        $message = [
            'idCliente.required' => "O campo 'idCliente' é obrigatório.",
        ];
        return $message;
    }

    public function showAll($request){
        $order = ($request->order ?? 'asc');
        $request->quantPagina = ($request->quantPagina ?? 20);
        switch ($request->orderCampo) {
            case ('id'):
                $campo = 'pedidos.id';
                break;
            case ('codBarras'):
                $campo = 'pedidos.codBarras';
                break;
            case ('dataPedido'):
                $campo = 'pedidos.dataPedido';
                break;
            case ('descricao'):
                $campo = 'status.descricao';
                break;
            case ('nome'):
                $campo = 'clientes.nome';
                break;
            case ('valorTotal'):
                $campo = 'pedidos.valorTotal';
                break;
            default:
                $campo = 'pedidos.id';
        }
        return self::select('pedidos.id', 'pedidos.codBarras', 'pedidos.dataPedido', 'status.descricao', 'clientes.nome', 'pedidos.valorTotal')
                ->join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
                ->join('status', 'pedidos.status', '=', 'status.id')
                ->where(function ($query) use ($request){
                    $query->orWhere('pedidos.id', 'like','%'.$request->filtro.'%')
                        ->orWhere('pedidos.codBarras', 'like','%'.$request->filtro.'%')
                        ->orWhere('pedidos.dataPedido', 'like','%'.$request->filtro.'%')
                        ->orWhere('status.descricao', 'like','%'.$request->filtro.'%')
                        ->orWhere('clientes.nome', 'like','%'.$request->filtro.'%')
                        ->orWhere('pedidos.valorTotal', 'like','%'.$request->filtro.'%');
                })
                ->orderBy($campo, $order)
                ->paginate($request->quantPagina);
    }

    public function showOne(){
        $pedidos = DB::table('pedidos')
            ->select('pedidos.id', 'pedidos.codBarras', 'pedidos.dataPedido', 'status.descricao', 'clientes.nome', 'pedidos.valorTotal')
            ->join('clientes', 'pedidos.idCliente', '=', 'clientes.id')
            ->join('status', 'pedidos.status', '=', 'status.id')
            ->first();
        $produtos = DB::table('pedidos')
            ->select('produtos.id', 'produtos.nomeProduto', 'produtos.valorUnitario')
            ->join('pedidos_produtos', 'pedidos.id', '=', 'pedidos_produtos.idPedido')
            ->join('produtos', 'produtos.id', '=', 'pedidos_produtos.idProduto')
            ->get();

        $pedidos->produtos = $produtos;
        return $pedidos;
    }

    public function cadastro($request){
        $PedidoProduto = new PedidosProdutos();
        $Produto = new Produto();
        $codBarras = Hash::make(strtotime('now'));
        $dataPedido = date('Y-m-d H:i:s', strtotime('now')-10800);
        $valorTotal = 0;

        $produtos = DB::table('produtos')->select('id', 'quantidade', 'valorUnitario')->get();

        foreach($request->produtos as $produto){
            if($produtos->where('id', $produto['idProduto'])->first() === null){
                return response()->json([
                    'message' => 'Não foi encontrado este produto.'
                ], 400);
            }

            if ($produtos->where('id', $produto['idProduto'])->first()->quantidade < $produto['quantidade']){
                return response()->json([
                    'message' => 'Não possuímos essa quantidade de produtos em nosso estoque.'
                ], 400);
            }

            $valorTotal = $valorTotal + $produtos->where('id', $produto['idProduto'])->first()->valorUnitario * $produto['quantidade'];
        }

        $validate = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validate->fails())
        {
            return response()->json($validate->errors()->messages(), 400);
        }

        $pedido = self::create([
            'codBarras' => $codBarras,
            'dataPedido' => $dataPedido,
            'status' => $request->status,
            'idCliente' => $request->idCliente,
            'valorTotal' => $valorTotal
        ]);

        foreach($request->produtos as $produto){
            $PedidoProduto->create([
                'idProduto' => $produto['idProduto'],
                'quantidadeProduto' => $produto['quantidade'],
                'idPedido' => $pedido->id
            ]);

            $Produto->where('id', $produto['idProduto'])->update([
                'quantidade' => $produtos->where('id', $produto['idProduto'])->first()->quantidade - $produto['quantidade']
            ]);
        }

        return response()->json([
            'message' => 'Pedido realizado com sucesso!'
        ], 201);
    }

    public function atualizar($request, $id)
    {
        $valorTotal = self::where('id', $id)->first()->valorTotal;

        if($request->produtosExcluir != null){
            foreach ($request->produtosExcluir as $produtoId){
                $result = DB::table('pedidos_produtos')
                    ->select('pedidos_produtos.quantidadeProduto', 'produtos.valorUnitario', 'produtos.quantidade', 'pedidos_produtos.id')
                    ->join('produtos', 'produtos.id', 'pedidos_produtos.idProduto')
                    ->where('produtos.id', $produtoId)
                    ->first();

                DB::table('produtos')
                    ->where('id', $produtoId)
                    ->update(['quantidade' => ($result->quantidade + $result->quantidadeProduto)]);

                DB::table('pedidos_produtos')
                    ->where('id', $result->id)
                    ->delete();

                $valorTotal = $valorTotal - ($result->quantidadeProduto * $result->valorUnitario);
            }
        }

        if($request->produtosCadastro != null){
            foreach ($request->produtosCadastro as $produto){
                $result = DB::table('pedidos_produtos')
                    ->select('pedidos_produtos.quantidadeProduto', 'produtos.valorUnitario', 'produtos.quantidade', 'pedidos_produtos.id')
                    ->join('produtos', 'produtos.id', 'pedidos_produtos.idProduto')
                    ->where('produtos.id', $produto['idProduto'])
                    ->first();

                if (isset($result)){
                    DB::table('produtos')
                        ->where('id', $produto['idProduto'])
                        ->update(['quantidade' => ($result->quantidade + $result->quantidadeProduto)]);

                    DB::table('pedidos_produtos')
                        ->where('id', $result->id)
                        ->delete();

                    $valorTotal = $valorTotal - ($result->quantidadeProduto * $result->valorUnitario);
                }
            }

            foreach ($request->produtosCadastro as $produtos){
                $produto = DB::table('produtos')->where('id', $produtos['idProduto'])->first();
                if ($produto->quantidade < $produtos['quantidade']){
                    return response()->json([
                        'message' => 'Não possuímos essa quantidade de produtos em nosso estoque.'
                    ], 400);
                }

                DB::table('pedidos_produtos')
                    ->insert([
                        'idProduto' => $produtos['idProduto'],
                        'quantidadeProduto' => $produtos['quantidade'],
                        'idPedido' => $id
                    ]);

                DB::table('produtos')
                    ->where('id', $produtos['idProduto'])
                    ->update([
                        'quantidade' => $produto->quantidade - $produtos['quantidade']
                    ]);

                $valorTotal = $valorTotal + ($produto->valorUnitario * $produtos['quantidade']);
            }
        }

        self::where('id', $id)
            ->update([
                'valorTotal' => $valorTotal,
                'status' => $request->status
            ]);

        return response()->json([
            'message' => 'Pedido atualizado com sucesso!'
        ], 200);
    }

    public function pagar($id){
        if(!self::where('id', $id)->exists()){
            return response()->json([
                'message' => 'Não foi encontrado este pedido.'
            ], 400);
        }

        if (self::where('id', $id)->first()->status != 1){
            return response()->json([
                'message' => 'Não é possível realizar o pagamento deste pedido.'
            ], 400);
        }

        if (self::where('id', $id)->update(['status' => 2])){
            return response()->json([
                'message' => 'Pedido pago.'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao pagar pedido.'
        ], 400);
    }

    public function cancelar($id){
        $Produto = new Produto();
        if(!self::where('id', $id)->exists()){
            return response()->json([
                'message' => 'Não foi encontrado este pedido.'
            ], 400);
        }

        if (self::where('id', $id)->first()->status != 1){
            return response()->json([
                'message' => 'Não é possível cancelar este pedido.'
            ], 400);
        }

        $produtos = DB::table('pedidos_produtos')
            ->select('idProduto', 'quantidadeProduto')
            ->join('pedidos', 'pedidos.id', '=', 'pedidos_produtos.idPedido')
            ->get();

        foreach($produtos as $produto){
            $Produto->where('id', $produto->idProduto)->update([
                'quantidade' => $Produto->where('id', $produto->idProduto)->first()->quantidade + $produto->quantidadeProduto
            ]);
        }

        if (self::where('id', $id)->update(['status' => 3])){
            return response()->json([
                'message' => 'Pedido cancelado.'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao pagar pedido.'
        ], 400);
    }

    public function deletar($id){
        $Produto = new Produto();
        $PedidosProdutos = new PedidosProdutos();

        if(!self::where('id', $id)->exists()){
            return response()->json([
                'message' => 'Não foi encontrado este pedido.'
            ], 400);
        }

        $produtos = DB::table('pedidos_produtos')
                        ->select('idProduto', 'quantidadeProduto')
                        ->join('pedidos', 'pedidos.id', '=', 'pedidos_produtos.idPedido')
                        ->get();

        foreach($produtos as $produto){
            $Produto->where('id', $produto->idProduto)->update([
                'quantidade' => $Produto->where('id', $produto->idProduto)->first()->quantidade + $produto->quantidadeProduto
            ]);
        }

        if($PedidosProdutos->where('idPedido', $id)->delete() && self::where('id', $id)->delete()){
            return response()->json([
                'message' => 'Pedido excluído com sucesso.'
            ], 200);
        }

        return response()->json([
            'message' => 'Erro ao excluir pedido.'
        ], 400);

    }
}
