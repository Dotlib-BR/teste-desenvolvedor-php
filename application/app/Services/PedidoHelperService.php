<?php

namespace App\Services;

use App\Contracts\Repositories\CupomDescontoInterface;
use App\Contracts\Repositories\PedidoInterface;
use App\Contracts\Repositories\PedidoProdutoInterface;

class PedidoHelperService extends BaseService
{
    protected $produtoService;

    protected $pedidoProdutoRepository;

    protected $cupomDescontoRepository;

    public function __construct(
        PedidoInterface $pedidoRepository,
        PedidoProdutoInterface $pedidoProdutoInterface,
        ProdutoService $produtoService,
        CupomDescontoInterface $cupomDescontoInterface
    ) {
        parent::__construct($pedidoRepository);
        $this->pedidoProdutoRepository = $pedidoProdutoInterface;
        $this->produtoService = $produtoService;
        $this->cupomDescontoRepository = $cupomDescontoInterface;
    }

    protected function cadastraProdutosEmPedido(int $pedido_id, object $produtos)
    {
        foreach ($produtos as $produto) {
            $this->pedidoProdutoRepository->create([
                'pedido_id'      => $pedido_id,
                'produto_id'     => $produto->id,
                'quantidade'     => $produto->quantidade,
                'valor_unitario' => $produto->valor,
                'subtotal'       =>  $produto->subtotal,
            ]);
        }
    }

    public function novoNumeroPedido($id)
    {
        return $this->formataNumero($id);
    }

    protected function formataNumero($num)
    {
        return 'DL' . str_pad($num, 8, '0', STR_PAD_LEFT);
    }

    public static $statusPedidos = [
        'aberto' => 1,
        'pago' => 2,
        'cancelado' => 3,
    ];

    protected function calculaDesconto(float $valorTotal, int $cupom_id)
    {
        $cupom = $this->cupomDescontoRepository->find($cupom_id);

        $desconto = ($valorTotal * ($cupom->valor / 100));

        return $desconto;
    }
}
