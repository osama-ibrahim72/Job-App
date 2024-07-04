<?php

namespace App\Providers;

use App\Events\PositionCreatedEvent;
use App\Listeners\PositionCreatedListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected  $listen =[
        PositionCreatedEvent::class=>[
            PositionCreatedListener::class,
        ]
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }



}
