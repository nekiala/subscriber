<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Jobs\ProcessPostNotification;

readonly class CreatePostUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private PostServiceInterface    $service,
        private PostRepositoryInterface $repository
    )
    {
    }

    public function execute(array $data): array
    {
        $payload = $this->service->validate($data);

        $post = $this->repository->create($payload);

        //$this->service->notifySubscribers($post);

        // dispatch notification
        ProcessPostNotification::dispatch($post)->delay(now()->addSeconds(10));

        // return the response
        return $this->service->getResponse($payload);
    }
}
