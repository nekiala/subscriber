<?php

namespace App\Repositories;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Models\Subscription;
use Illuminate\Support\Collection;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    public function create(array $payload): void
    {
        Subscription::create($payload);
    }

    public function userAlreadySubscribed(array $prepareSubscriptionCheck): bool
    {
        return Subscription::where($prepareSubscriptionCheck)->exists();
    }

    public function getSubscribers(array $array_unique): Collection
    {
        return Subscription::whereIn('website_id', $array_unique)->get();
    }
}
