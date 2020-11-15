<?php

namespace App\Providers;

use App\Repositories\Eloquent\ProfileRepository;
use App\Repositories\Eloquent\ReplyRepository;
use App\Repositories\Eloquent\ThreadRepository;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\ReplyRepositoryInterface;
use App\Repositories\ThreadRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ThreadRepositoryInterface::class, ThreadRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ReplyRepositoryInterface::class, ReplyRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
