<?php

namespace App\Repositories;

use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{

    /**
     * Creates a new subscription record in the database.
     *
     * @param array $payload The subscription data to be stored.
     * @return void
     */
    public function create(array $payload): void
    {
        Subscription::create($payload);
    }

    /**
     * Checks if a user is already subscribed based on the provided criteria.
     *
     * @param array $prepareSubscriptionCheck Array of parameters to filter existing subscriptions.
     * @return bool True if the user is already subscribed; otherwise, false.
     */
    public function userAlreadySubscribed(array $prepareSubscriptionCheck): bool
    {
        return Subscription::where($prepareSubscriptionCheck)->exists();
    }

    /**
     * Retrieve a collection of subscribers associated with the provided website IDs.
     *
     * @param array $websiteIds List of website IDs to retrieve subscribers for.
     */
    public function getSubscribers(array $websiteIds, int $chunkSize, callable $callback):void
    {
        Subscription::whereIn('website_id', $websiteIds)
            ->chunk($chunkSize, function ($subscribers) use ($callback) {
                $callback($subscribers);
            });

    }
}
