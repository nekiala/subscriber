<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Notifications\SendPostNotification;
use App\Repositories\PostRepository;
use App\Repositories\SubscriptionRepository;
use Log;

readonly class SendPostNotificationUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private PostRepository $repository,
        private SubscriptionRepository $subscriptionRepository
    )
    {


    }

    public function execute(array $data): void
    {
        // get unpublished posts
        $unpublishedPosts = $this->repository->getUnpublishedPosts();

        // extract websites
        $websites = [];
        $unpublishedPosts->each(function ($post) use (&$websites) {
            $websites[] = $post->website_id;
        });

        // get subscribed users from these websites
        dispatch(function () use ($websites, $unpublishedPosts) {

            $subscribers = $this->subscriptionRepository->getSubscribers(array_unique($websites));

            foreach ($unpublishedPosts as $unpublishedPost) {

                $subscribers->each(function ($subscriber) use ($unpublishedPost) {

                    Log::debug("sending notification to {$subscriber->user->email}");

                    $subscriber->user->notify(new SendPostNotification($unpublishedPost));

                    Log::debug("notification sent to {$subscriber->user->email}");
                });
            }
        });

    }
}
