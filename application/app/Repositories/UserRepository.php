<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserInterface;
use App\User;

class UserRepository extends BaseRepository implements UserInterface
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
