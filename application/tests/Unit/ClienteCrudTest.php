<?php

namespace Tests\Unit;

use App\Contracts\Repositories\ClienteInterface;
use App\Services\ClienteService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use stdClass;

class ClienteCrudTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected ClienteInterface $clienteInterface;
    protected ClienteService $clienteService;

    public $cliente;

    public function setUp(): void
    {
        parent::setUp();

        $this->clienteService = app(ClienteService::class);
        $this->clienteInterface = app(ClienteInterface::class);

        $this->cliente = new stdClass;
        $this->cliente->nome = 'leonel rodrigo alves de souza';
        $this->cliente->email = 'rd7.rodrigo@gmail.com';
        $this->cliente->cpf = '000.000.000-09';
        $this->cliente->password = 12345678;

    }

    public function testCadastraNovoCliente()
    {
        $cliente = $this->clienteService->create($this->cliente->nome, $this->cliente->email, $this->cliente->cpf, $this->cliente->password);

        $this->assertEquals($this->cliente->nome, $cliente->nome);

        $this->assertDatabaseHas('clientes', ['email' => $this->cliente->email, 'nome' => $this->cliente->nome]);
    }

    public function testAtualizaCliente()
    {
        $cliente = $this->clienteService->create($this->cliente->nome, $this->cliente->email, $this->cliente->cpf, $this->cliente->password);
        $this->assertEquals($this->cliente->nome, $cliente->nome);

        $testUpdated = factory($this->clienteInterface->getModel())->make();

        $clienteNovo = $this->clienteService->update($cliente->id, [
            'nome' => $testUpdated->nome
        ]);

        $this->assertTrue($clienteNovo);

        $verificaCliente = $this->clienteInterface->find($cliente->id);

        $this->assertNotEquals($cliente->nome, $verificaCliente->nome);

    }

    public function testDeletaCliente()
    {
        $cliente = $this->clienteService->create($this->cliente->nome, $this->cliente->email, $this->cliente->cpf, $this->cliente->password);

        $delete = $this->clienteService->delete(
            $cliente->id
        );

        $this->assertTrue($delete);

    }
}
