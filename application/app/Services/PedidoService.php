<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PedidoService extends PedidoHelperService
{
    public function create(int $cliente_id, array $produtosArr = [], $cupom_desconto_id = null)
    {
        DB::beginTransaction();

        try {
            $idProdutos = Arr::pluck($produtosArr, ['produto_id']);

            $recuperaProdutos = $this->produtoService->recuperaProdutos($idProdutos);

            if (count($recuperaProdutos) < count($produtosArr)) {
                throw new \Exception("Alguns produtos não estão disponiveis", 1);
            }

            $valorTotalProdutos = $this->produtoService->somaProdutos($recuperaProdutos, $produtosArr);

            $valorTotal = $valorTotalProdutos['subtotal'];

            $valorDesconto = null;

            if ($cupom_desconto_id) {
                $valorDesconto = $this->calculaDesconto($valorTotal, $cupom_desconto_id);
                if ($valorDesconto > 0) {
                    $valorTotal -= $valorDesconto;
                }
            }

            $pedido = $this->repository->create([
                'cliente_id'        => $cliente_id,
                'status_pedido_id'  => self::$statusPedidos['aberto'],
                'cupom_desconto_id' => $cupom_desconto_id,
                // 'numero_pedido',
                'valor_pedido' => $valorTotalProdutos['subtotal'],
                'valor_desconto' => $valorDesconto,
                'valor_total' => $valorTotal,
            ]);

            $this->cadastraProdutosEmPedido($pedido->id, $recuperaProdutos);

            $pedido->update([
                'numero_pedido' => $this->novoNumeroPedido($pedido->id),
            ]);

            $pedido = $this->repository->find($pedido->id);

            DB::commit();

            return $pedido;
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }

    public function listarPedidos($pag)
    {
        return $this->repository->newQuery()->with('statusPedido')->filter()->orderBy('status_pedido_id')->orderBy('created_at', 'asc')->paginate($pag);
    }

    public function getPedido($id)
    {
        return $this->repository->newQuery()->with(['cliente', 'pedidoProdutos.produto', 'cupomDesconto'])->find($id);
    }


}
