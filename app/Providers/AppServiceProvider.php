<?php

namespace App\Providers;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\SubscriptionRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\SubscriptionServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Repositories\PostRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\UserRepository;
use App\Services\PostService;
use App\Services\SubscriptionService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // register repositories
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
        $this->app->singleton(SubscriptionRepositoryInterface::class, SubscriptionRepository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);

        // register services
        $this->app->singleton(PostServiceInterface::class, PostService::class);
        $this->app->singleton(SubscriptionServiceInterface::class, SubscriptionService::class);
        $this->app->singleton(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
    }
}
