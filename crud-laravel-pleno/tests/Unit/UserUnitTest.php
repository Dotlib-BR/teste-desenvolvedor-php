<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_user()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'access_level' => ('User'),
        ];

        $user = User::create($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame($userData['name'], $user->name);
    }

    /** @test */
    public function can_update_user()
    {
        $user = User::factory()->create();

        $newData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('newpassword'),
            'access_level' => ('Admin'),
        ];

        $user->update($newData);

        $this->assertSame($newData['name'], $user->name);
        $this->assertSame($newData['email'], $user->email);
    }

    /** @test */
    public function can_delete_user()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function can_retrieve_user()
    {
        $user = User::factory()->create();

        $retrievedUser = User::find($user->id);

        $this->assertInstanceOf(User::class, $retrievedUser);
        $this->assertSame($user->name, $retrievedUser->name);
    }
}
