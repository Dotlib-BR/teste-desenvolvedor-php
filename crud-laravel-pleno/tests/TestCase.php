<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Criar teste de usuario para autenticacao.
     *
     * @return \App\Models\User
     */
    protected function createTestUser()
    {
        return \App\Models\User::factory()->create([
            'email' => 'test@example.com',
        ]);
    }
}
