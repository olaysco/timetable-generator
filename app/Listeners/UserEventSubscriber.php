<?php

namespace App\Listeners;

use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\PasswordTokenGenerated;
use Illuminate\Notifications\Messages\MailMessage;


class UserEventSubscriber implements ShouldQueue
{

    public function onResetRequested($event)
    {
        $user = User::first();
        $user->email = $event->email;

        if ($user) {
            $user->notify(new PasswordTokenGenerated($event->token));
        }
    }

    /**
     * Register listeners for the various user events.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\PasswordResetRequested',
            'App\Listeners\UserEventSubscriber@onResetRequested'
        );
    }
}
