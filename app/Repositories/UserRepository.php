<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    public function create(array $payload): User
    {
        if (User::where('email', $payload['email'])->exists()) {
            return User::where('email', $payload['email'])->first();
        }

        return User::create($payload);
    }
}
