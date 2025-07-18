<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public function create(array $userData): User
    {
        if (User::where('email', $userData['email'])->exists()) {
            return User::where('email', $userData['email'])->first();
        }

        return User::create($userData);
    }
}
