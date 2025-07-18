<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\SubscriptionService;
use RuntimeException;

readonly class SubscribeUserUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private SubscriptionRepository $repository,
        private SubscriptionService $service,
        private UserRepository $userRepository
    )
    {
    }

    public function execute(array $data): void
    {
        // create a user if not exist

        $userData = $this->service->prepareSubscriberData($data);
        $user = $this->userRepository->create($userData);

        $data = array_merge($data, ['id' => $user->id]);

        // check a user's subscription exists
        if ($this->repository->userAlreadySubscribed(
            $this->service->prepareSubscriptionCheck($data)
        )) {

            throw new RuntimeException('User already subscribed');
        }


        $payload = $this->service->validateSubscriptionData($data);


        $this->repository->create($payload);
    }
}
