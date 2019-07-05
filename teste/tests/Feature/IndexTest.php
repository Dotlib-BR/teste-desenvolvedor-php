<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use DatabaseTransactions;//para dar um "rollback" quando inserir algo no banco, de forma automática!

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestSkipped('Skipped the testIndex of the IndexTest.');
    }
}
