<?php

namespace App\Listeners;


use App\Jobs\RankTimeslots;
use Illuminate\Contracts\Queue\ShouldQueue;


class TimeslotEventSubscriber implements ShouldQueue
{
    /**
     * Handle when timeslots have been updated
     *
     * @param  App\Events\TimeslotsUpdatedRequested $event
     */
    public function onTimeslotsUpdated($event)
    {
        dispatch(new RankTimeslots());
    }

    /**
     * Register listeners for the various user events.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\TimeslotsUpdated',
            'App\Listeners\TimeslotEventSubscriber@onTimeslotsUpdated'
        );
    }
}
