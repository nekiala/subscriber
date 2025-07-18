<?php

namespace App\Repositories;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;

class PostRepository implements PostRepositoryInterface
{

    public function create(array $payload): Post
    {
        return Post::create($payload);
    }

    public function getUnpublishedPosts($limit = 5): Collection
    {
        return Post::where('is_published', false)->limit($limit)->get();
    }
}
