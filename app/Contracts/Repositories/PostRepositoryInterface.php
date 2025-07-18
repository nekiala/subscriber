<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;

interface PostRepositoryInterface extends BaseRepositoryInterface
{

    public function create(array $payload): Post;

    public function getUnpublishedPosts($limit = 5): Collection;
}
