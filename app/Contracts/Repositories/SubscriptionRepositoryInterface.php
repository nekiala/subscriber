<?php

namespace App\Contracts\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Support\Collection;

interface SubscriptionRepositoryInterface extends BaseRepositoryInterface
{
    public function userAlreadySubscribed(array $prepareSubscriptionCheck): bool;

    public function getSubscribers(array $array_unique): Collection;
}
