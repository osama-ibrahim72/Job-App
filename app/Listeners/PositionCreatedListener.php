<?php

namespace App\Listeners;

use App\Events\PositionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PositionCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PositionCreatedEvent $event): void
    {
        $event->mgrs->map(function ($mgr) use ($event){
            $mgr->notifications()->create([
                'position_id'  =>$event->position->id
            ]);
        });
    }
}
