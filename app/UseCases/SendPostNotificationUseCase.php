<?php

namespace App\UseCases;

use App\Contracts\BaseUseCaseInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Notifications\SendPostNotification;
use Log;

readonly class SendPostNotificationUseCase implements BaseUseCaseInterface
{
    public function __construct(
        private PostRepositoryInterface $repository,
        private SubscriptionRepositoryInterface $subscriptionRepository
    )
    {


    }

    public function execute(array $data): void
    {
        // get 5 unpublished posts
        $unpublishedPosts = $this->repository->getUnpublishedPosts();

        // extract websites
        $websites = [];
        $unpublishedPosts->each(function ($post) use (&$websites) {
            $websites[] = $post->website_id;
        });

        // get subscribed users from these websites
        // notify them. the task is running in the background
        dispatch(function () use ($websites, $unpublishedPosts) {

            $subscribers = $this->subscriptionRepository->getSubscribers(array_unique($websites));

            if ($subscribers->isEmpty()) {
                Log::debug('no subscribers found');
                return;
            }

            foreach ($unpublishedPosts as $unpublishedPost) {

                $subscribers->each(function ($subscriber) use ($unpublishedPost) {

                    Log::debug("sending notification to {$subscriber->user->email}");

                    $subscriber->user->notify(new SendPostNotification($unpublishedPost));

                    Log::debug("notification sent to {$subscriber->user->email}");
                });

                // update the "post" status
                // could use the repository...
                $unpublishedPost->update(['is_published' => true]);
            }
        });

    }
}
