<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_client()
    {
        $response = $this->get('/client');

        $response->assertViewIs("client.index");
        $response->assertViewHas("clients");
        $response->assertStatus(200);
    }

    public function test_create_client()
    {
        $response = $this->get('/client/create');

        $response->assertViewIs("client.create");
        $response->assertStatus(200);
    }
}
