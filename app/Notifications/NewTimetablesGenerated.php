<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Timetable;
use App\Models\ProfessorSchedule;

class NewTimetablesGenerated extends Notification
{
    use Queueable;

    /**
     * Instance of timetable model from DB
     *
     * @var App\Models\Timetable
     */
    public $timetable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $schedules = [];
        $days = $this->timetable->days;

        foreach ($days as $day) {
            $schedules[$day->name] = ProfessorSchedule::with(['timetable', 'professor', 'course', 'day', 'timeslot', 'room', 'college_class'])
                ->where('timetable_id', $this->timetable->id)
                ->where('professor_id', $notifiable->id)
                ->where('day_id', $day->id)
                ->join('timeslots', 'timeslots.id', '=', 'professor_schedules.timeslot_id')
                ->orderBy('timeslots.rank')
                ->get();
        }

        $url = env('APP_URL') . '/timetables/view/' . $this->timetable->id;

        $data = [
            'schedules' => $schedules,
            'professor' => $notifiable,
            'url' => $url
        ];

        return (new MailMessage)
                    ->subject('Schedules for ' . $this->timetable->name)
                    ->markdown('emails.professor_schedules', $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
