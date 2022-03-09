<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService {
    /**
     * Create user in Database
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function createUser(string $name, string $email, string $password): User
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }

    /**
     * Search influencer by email
     *
     * @param string $email
     * @return User|null
     */
    public function searchInfluencerByEmail(string $email): User | null {
        $user = User::where('email', $email)->first();

        return $user ?? null;
    }

    /**
     * Check user password
     *
     * @param User $user
     * @param string $password
     * @return boolean
     */
    public function checkUserPassword(User $user, string $password): bool {
        return Hash::check($password, $user->password);
    }

    /**
     * Create token api to user
     *
     * @param User $user
     * @return string
     */
    public function createTokenApiToUser(User $user)
    {
        $token = $user->createToken('token_api')->plainTextToken;
        $user->api_token = $token;
        $user->save();

        return $token;
    }
}
