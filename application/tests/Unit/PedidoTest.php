<?php

namespace Tests\Unit;

use App\Contracts\Repositories\CupomDescontoInterface;
use App\Contracts\Repositories\PedidoInterface;
use App\Contracts\Repositories\PedidoProdutoInterface;
use App\Contracts\Repositories\ProdutoInterface;
use App\Services\ClienteService;
use App\Services\PedidoService;
use App\Services\ProdutoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;

class PedidoTest extends TestCase
{
    use DatabaseTransactions;

    protected PedidoService $pedidoService;
    protected PedidoInterface $pedidoInterface;
    protected ClienteService $clienteService;
    protected ProdutoService $produtoService;
    protected ProdutoInterface $produtoInterface;
    protected PedidoProdutoInterface $pedidoProdutoInterface;
    protected CupomDescontoInterface $cupomDescontoInterface;


    public function setUp(): void
    {
        parent::setUp();
        $this->pedidoService = app(PedidoService::class);
        $this->pedidoInterface = app(PedidoInterface::class);
        $this->clienteService = app(ClienteService::class);
        $this->produtoService = app(ProdutoService::class);
        $this->produtoInterface = app(ProdutoInterface::class);
        $this->pedidoProdutoInterface = app(PedidoProdutoInterface::class);
        $this->cupomDescontoInterface = app(CupomDescontoInterface::class);

        $this->cliente = new stdClass;
        $this->cliente->nome = 'leonel rodrigo alves de souza';
        $this->cliente->email = 'rd7.rodrigo@gmail.com';
        $this->cliente->cpf = '000.000.000-09';
        $this->cliente->password = 12345678;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNovoPedido()
    {
        $cliente = $this->clienteService->create($this->cliente->nome, $this->cliente->email, $this->cliente->cpf, $this->cliente->password);
        $this->assertDatabaseHas('clientes', ['email' => $this->cliente->email, 'nome' => $this->cliente->nome]);

        $produtos = factory($this->pedidoProdutoInterface->getModel(), 3)->make();


        $cupomDesconto = factory($this->cupomDescontoInterface->getModel())->create();

        $produtosArr = [];

        foreach ($produtos as $key => $produto) {
            $produtosArr[$produto->produto_id]['produto_id'] = $produto->produto_id;
            $produtosArr[$produto->produto_id]['quantidade'] = $produto->quantidade;
        }
        dd($produtosArr);
        $novoPedido = $this->pedidoService->create($cliente->id, $produtosArr, $cupomDesconto->id);

        $this->assertDatabaseHas('pedidos', ['cliente_id' => $cliente->id, 'id' => $novoPedido->id]);

        $this->assertCount(count($produtosArr), $novoPedido->produtos->toArray());

    }
}
