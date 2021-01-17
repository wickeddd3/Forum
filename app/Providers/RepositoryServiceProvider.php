<?php

namespace App\Providers;

use App\Interfaces\ChannelRepositoryInterface;
use App\Interfaces\ProfileRepositoryInterface;
use App\Interfaces\ReplyRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use App\Repositories\ChannelRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\ReplyRepository;
use App\Repositories\ThreadRepository;

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
        $this->app->bind(ChannelRepositoryInterface::class, ChannelRepository::class);
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
