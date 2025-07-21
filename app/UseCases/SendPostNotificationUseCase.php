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
        $websiteIds = $unpublishedPosts->pluck('website_id')->unique()->toArray();


        // get subscribed users from these websites
        // notify them. the task is running in the background
        dispatch(function () use ($websiteIds, $unpublishedPosts) {

            $this->subscriptionRepository->getSubscribers($websiteIds, 100, function ($subscribers) use ($unpublishedPosts) {

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
        });

    }
}
