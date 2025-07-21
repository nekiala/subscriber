<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepositoryInterface;

interface SubscriptionRepositoryInterface extends BaseRepositoryInterface
{
    public function userAlreadySubscribed(array $prepareSubscriptionCheck): bool;

    public function getSubscribers(array $websiteIds, int $chunkSize, callable $callback): void;
}
