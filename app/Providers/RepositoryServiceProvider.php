<?php

namespace App\Providers;

use App\Interfaces\ReplyRepositoryInterface;
use App\Interfaces\TicketRepositoryInterface;
use App\Repositories\ReplyRepository;
use App\Repositories\TicketRepository;
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
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
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
