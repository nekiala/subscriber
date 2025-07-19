<?php

namespace App\Contracts\Services;

use App\Models\Post;

interface PostServiceInterface
{
    public function validate(array $data): array;

    public function getResponse(array $payload): array;

    public function notifySubscribers(Post $post): void;
}
