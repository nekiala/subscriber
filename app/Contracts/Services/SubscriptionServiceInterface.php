<?php

namespace App\Contracts\Services;

interface SubscriptionServiceInterface
{
    public function prepareSubscriptionCheck(array $data): array;

    public function validateSubscriptionData(array $data): array;

    public function prepareSubscriberData(array $data): array;
}
