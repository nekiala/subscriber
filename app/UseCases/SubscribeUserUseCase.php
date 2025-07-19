<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\SubscriptionServiceInterface;
use RuntimeException;

readonly class SubscribeUserUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private SubscriptionRepositoryInterface $repository,
        private SubscriptionServiceInterface $service,
        private UserRepositoryInterface $userRepository
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
