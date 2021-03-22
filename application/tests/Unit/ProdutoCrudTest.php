<?php

namespace Tests\Unit;

use App\Contracts\Repositories\ProdutoInterface;
use App\Services\ProdutoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoCrudTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected ProdutoService $produtoService;
    protected ProdutoInterface $produtoInterface;

    public function setUp(): void
    {
        parent::setUp();
        $this->produtoService = app(ProdutoService::class);
        $this->produtoInterface = app(ProdutoInterface::class);
    }

    public function testCadastraNovoProduto()
    {
        $test = factory($this->produtoInterface->getModel())->make();
        $produto = $this->produtoService->create($test->nome, $test->cod_barras, $test->valor, $test->qtd_estoque, $test->ativo);

        $this->assertEquals($test->nome, $produto->nome);

        $this->assertDatabaseHas('produtos', ['cod_barras' => $test->cod_barras, 'nome' => $test->nome]);
    }

    public function testAtualizaProduto()
    {
        $test = factory($this->produtoInterface->getModel())->create();
        $testUpdated = factory($this->produtoInterface->getModel())->make();

        $produto = $this->produtoService->update($test->id, [
            'nome' => $testUpdated->nome,
            'valor' => $testUpdated->valor,
            'qtd_estoque' => $testUpdated->qtd_estoque,
            'ativo' => $testUpdated->ativo
        ]);

        $this->assertTrue($produto);
    }

    public function testDeletaProdutos()
    {
        $produto = factory($this->produtoInterface->getModel())->create();

        $del1 = $this->produtoService->delete(
            $produto->id
        ); //deleta 1 produto

        $this->assertTrue($del1);

        $produtos = [
            factory($this->produtoInterface->getModel())->create()->id,
            factory($this->produtoInterface->getModel())->create()->id,
            factory($this->produtoInterface->getModel())->create()->id,
        ];

        $del2 = $this->produtoService->delete($produtos); //deleta vários

        $this->assertEquals(count($produtos), $del2);
    }
}
