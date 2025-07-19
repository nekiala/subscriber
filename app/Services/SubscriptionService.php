<?php

namespace App\Services;

use App\Contracts\Services\SubscriptionServiceInterface;
use Hash;
use RuntimeException;

class SubscriptionService implements SubscriptionServiceInterface
{

    public function prepareSubscriptionCheck(array $data): array
    {
        if (!isset($data['id'], $data['website'])) {

            throw new RuntimeException('Invalid subscription data');
        }

        return [
            'user_id' => $data['id'],
            'website_id' => $data['website']
        ];
    }

    public function validateSubscriptionData(array $data): array
    {
        if (!isset($data['id'], $data['website'])) {

            throw new RuntimeException('Invalid subscription data');
        }

        return [
            'user_id' => $data['id'],
            'website_id' => $data['website']
        ];
    }

    public function prepareSubscriberData(array $data): array
    {
        if (!isset($data['email'], $data['name'])) {

            throw new RuntimeException('Invalid subscription data');
        }

        return [
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make(uniqid('a', true))
        ];
    }
}
