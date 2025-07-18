<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Repositories\PostRepository;
use App\Services\PostService;

readonly class CreatePostUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private PostService    $service,
        private PostRepository $repository
    )
    {
    }

    public function execute(array $data): array
    {
        $payload = $this->service->validate($data);

        $this->repository->create($payload);


        return $this->service->getResponse($payload);
    }
}
