<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Contracts\UserContracts::class,\App\Repositories\UserRepository::class);
        $this->app->bind(\App\Contracts\Admin\UserContracts::class,\App\Repositories\Admin\UserRepository::class);
        $this->app->bind(\App\Contracts\TagContracts::class,\App\Repositories\TagRepository::class);
        $this->app->bind(\App\Contracts\BlogContracts::class,\App\Repositories\BlogRepository::class);
        $this->app->bind(\App\Contracts\CommentContracts::class,\App\Repositories\CommentRepository::class);
        $this->app->bind(\App\Contracts\CountContracts::class,\App\Repositories\CountRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
