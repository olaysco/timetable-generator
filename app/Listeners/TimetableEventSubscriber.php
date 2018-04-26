<?php

namespace App\Listeners;


use App\Jobs\NotifyProfessors;
use App\Jobs\RenderTimetables;
use App\Jobs\GenerateTimetables;
use Illuminate\Contracts\Queue\ShouldQueue;


class TimetableEventSubscriber implements ShouldQueue
{
    /**
     * Handle request to generate a new set of timetables
     *
     * @param  App\Events\TimetableRequested $event
     */
    public function onTimetablesRequested($event)
    {
        dispatch(new GenerateTimetables($event->timetable));
    }

    public function onTimetablesGenerated($event)
    {
        dispatch(new RenderTimetables($event->timetable));
        dispatch(new NotifyProfessors($event->timetable));
    }


    /**
     * Register listeners for the various user events.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\TimetablesRequested',
            'App\Listeners\TimetableEventSubscriber@onTimetablesRequested'
        );

        $events->listen(
            'App\Events\TimetablesGenerated',
            'App\Listeners\TimetableEventSubscriber@onTimetablesGenerated'
        );
    }
}
