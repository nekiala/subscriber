<?php

namespace App\Services;

use App\Events\PostCreated;
use App\Models\Post;
use RuntimeException;

class PostService
{

    /**
     * @param array $data
     * @return array
     */
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

    /**
     * Processes the provided payload to extract specific keys and
     * generate a URL for the given slug.
     *
     * @param array $payload The array of data to process.
     * @return array The processed array including the title, slug, and URL.
     */
    public function getResponse(array $payload): array
    {
        $data = collect($payload)->only(['title', 'slug'])->toArray();
        $data['url'] = route('posts.show', $data['slug']);

        return $data;
    }

    /**
     * Notify all subscribers about a new post creation by dispatching the PostCreated event.
     *
     * @param Post $post The post instance to notify subscribers about.
     * @return void
     */
    /*public function notifySubscribers(Post $post): void
    {
        PostCreated::dispatch($post);
    }*/
}
