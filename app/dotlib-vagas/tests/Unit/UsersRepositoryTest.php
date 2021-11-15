<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repository\UsersRepository;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;


class UsersRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function verificar_pesquisa_users_carregamento_dados()
    {
        Session::start();
        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->pesquisar(['texto_busca'=> User::first()->email]);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function buscar_user_id_consultar()
    {
        Session::start();
        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->getUser(User::first()->id);

        $this->assertNotEmpty($result);

    }

    /**
     * @test
     */
    public function verificar_pesquisa_ordenada_carregamento_dados()
    {
        Session::start();
        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->getUsers('email');

        $this->assertNotEmpty($result);

        $result = $usersRepository->getUsers('name',true);

        $this->assertNotEmpty($result);

    }

    /**
     * @test
     */
    public function create_user_save()
    {
        $userFactory = new UserFactory();
        $userFake = $userFactory->definition();

        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->store($userFake);

        $this->assertTrue($result);

    }

    /**
     * @test
     */
    public function update_user_save()
    {
        $userFactory = new UserFactory();
        $userFake = $userFactory->definition();

        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->update(User::first()->id, $userFake);

        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function delete_user_excluir()
    {
        $usersRepository = new UsersRepository(new User());

        $result = $usersRepository->delete(User::first()->id);

        $this->assertTrue($result);
    }
}
