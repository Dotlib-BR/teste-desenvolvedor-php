<?php

namespace Tests\Unit;

use App\Models\AuxVagasUsers;
use App\Models\User;
use App\Models\Vaga;
use App\Repository\InscricoesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;


class InscricoesRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function verificar_pesquisa_inscricoes_carregamento_dados()
    {
        Session::start();

        AuxVagasUsers::factory(1)->create(['vaga_id'=> Vaga::first()->id]);

        $inscricoesRepository = new InscricoesRepository(new Vaga());

        $result = $inscricoesRepository->pesquisar(['texto_busca'=> Vaga::first()->titulo]);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function verificar_pesquisa_inscricoes_ordenada_carregamento_dados()
    {
        Session::start();
        $inscricoesRepository = new InscricoesRepository(new Vaga());

        $result = $inscricoesRepository->getInscricoes('titulo');

        $this->assertNotEmpty($result);

        $result = $inscricoesRepository->getInscricoes('alocacao',true);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function create_inscricoes_save()
    {
        $user = User::first();
        Auth::login($user);

        $inscricoesRepository = new InscricoesRepository(new Vaga());

        $result = $inscricoesRepository->setInscricaoUser(Vaga::first()->id);

        $this->assertTrue($result);

        $result = $inscricoesRepository->setInscricaoUser(Vaga::first()->id);

        $this->assertEquals(409, $result);
    }
}
