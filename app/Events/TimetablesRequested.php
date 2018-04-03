<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TimetablesRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Model of timetable to be generated
     *
     * @var App\Models\Timetable
     */
    public $timetable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
