<?php

namespace Tests\Feature\Zeus;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use DatabaseTransactions;//para dar um "rollback" quando inserir algo no banco, de forma automática!

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::find(rand(1, 50));//pego um usuário aleatório do banco

        $response = $this->get('/zeus/clients',[
            'Authorization' => 'Zeus '.$user->api_token
            //passo 'Zeus' para ter mais controle das requisições e organização.
        ]);

        $response->assertStatus(200);
    }
}
