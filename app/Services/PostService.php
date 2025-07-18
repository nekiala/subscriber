<?php

namespace App\Services;

use RuntimeException;

class PostService
{

    public function validate(array $data): array
    {
        if (!isset($data['title'], $data['description'])) {
            throw new RuntimeException("Bad post");
        }

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'slug' => str($data['title'])->slug(),
            'website_id' => $data['website']
        ];
    }

    public function getResponse(array $payload): array
    {
        $data = collect($payload)->only(['title', 'slug'])->toArray();
        $data['url'] = route('posts.show', $data['slug']);
        return $data;
    }
}
