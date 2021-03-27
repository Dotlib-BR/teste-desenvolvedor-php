<?php

namespace App\Services;

use App\Contracts\Repositories\ProdutoInterface;

class ProdutoService extends BaseService
{

    public function __construct(ProdutoInterface $produtoInterface)
    {
        parent::__construct($produtoInterface);
    }

    public function create(string $nome, int $cod_barras, float $valor, int $qtd_estoque = null, bool $ativo)
    {
        return $this->repository->create([
            'nome'          => $nome,
            'cod_barras'    => $cod_barras,
            'valor'         => $valor,
            'qtd_estoque'   => $qtd_estoque,
            'ativo'         => $ativo,
        ]);
    }

    public function somaProdutos($produtos, $produtosArr)
    {
        $subtotais = 0;

        if (count($produtos) > 0) {
            foreach ($produtos as $produto) {
                $produto->subtotal = $produto->valor * $produtosArr[$produto->id]['quantidade'];
                $produto->quantidade = $produtosArr[$produto->id]['quantidade'];
                $subtotais += $produto->subtotal;
            }
        }

        return [
            'produtos' => $produtos,
            'subtotal' => $subtotais
        ];
    }

    public function recuperaProdutos($idProdutos)
    {
        return $this->repository->getAtivos($idProdutos);
    }
}
