<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{

    public function create($payload): void
    {
        Post::create($payload);
    }
}
