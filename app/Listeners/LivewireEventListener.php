<?php

namespace App\Listeners;

use App\Events\LivewireEvent;
use App\Models\User;
use App\Notifications\LivewireEventNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class LivewireEventListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LivewireEvent  $event
     * @return void
     */
    public function handle(LivewireEvent $event)
    {
        $users = User::limit('10')->get();
        Notification::send($users, new LivewireEventNotification($event->actions));
    }
}
