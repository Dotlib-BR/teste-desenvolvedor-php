<?php

namespace Tests\Unit;

use App\Models\Vaga;
use App\Repository\VagasRepository;
use Database\Factories\VagaFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;


class VagasRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function verificar_pesquisa_vagas_carregamento_dados()
    {
        Session::start();
        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->pesquisar(['texto_busca'=> Vaga::first()->id]);

        $this->assertNotEmpty($result);

    }

    /**
     * @test
     */
    public function buscar_vaga_id_consultar()
    {
        Session::start();
        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->getVaga(Vaga::first()->id);

        $this->assertNotEmpty($result);

    }

    /**
     * @test
     */
    public function verificar_pesquisa_vagas_ordenada_carregamento_dados()
    {
        Session::start();
        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->getVagas('titulo');

        $this->assertNotEmpty($result);

        $result = $vagasRepository->getVagas('salario',true);

        $this->assertNotEmpty($result);

    }

    /**
     * @test
     */
    public function create_vaga_save()
    {
        $vagaFactory = new VagaFactory();
        $vagaFake = $vagaFactory->definition();

        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->store($vagaFake);

        $this->assertTrue($result);

    }

    /**
     * @test
     */
    public function update_vaga_save()
    {
        $vagaFactory = new VagaFactory();
        $vagaFake = $vagaFactory->definition();

        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->update(Vaga::first()->id, $vagaFake);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function delete_vaga_excluir()
    {
        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->delete(Vaga::first()->id);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function pausar_vaga_pausada()
    {
        $vagasRepository = new VagasRepository(new Vaga());

        $result = $vagasRepository->pausarVaga(Vaga::first()->id);

        $this->assertTrue($result);
    }
}
