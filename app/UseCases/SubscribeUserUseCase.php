<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Repositories\NotificationRepository;
use App\Repositories\PostRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\SubscriptionService;

class SubscribeUserUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private SubscriptionRepository $subscriptionRepository,
        private NotificationRepository $notificationRepository,
        private PostRepository $postRepository,
        private SubscriptionService $service
    )
    {
    }

    public function execute(array $data)
    {
        // TODO: Implement execute() method.
    }
}
