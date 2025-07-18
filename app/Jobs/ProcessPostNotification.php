<?php

namespace App\Jobs;

use App\Models\Post;
use App\UseCases\SendPostNotificationUseCase;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessPostNotification implements ShouldQueue, ShouldBeUniqueUntilProcessing, ShouldBeEncrypted
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(SendPostNotificationUseCase $useCase): void
    {
        $useCase->execute([]);
    }
}
