<p>Hello {{ $professor->name }}</p>
<p>Based on the new timetables generated, your weekly schedule is as follows</p>

<div style="padding: 30px;">
    @foreach ($schedules as $day => $daySchedules)
        @if (count($daySchedules))
            <h2>{{ $day }}s</h2>
            @foreach ($daySchedules as $schedule)
                <h3>{{ $schedule->timeslot->time }}</h3>
                <p>{{ $schedule->course->course_code }} - {{ $schedule->course->name }}</p>
                <p>{{ $schedule->college_class->name }}</p>
                <p>Room {{ $schedule->room->name }}</p>
            @endforeach
        @endif
    @endforeach
</div>

<a style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; text-decoration: none; padding-top: 5px;
padding-bottom: 5px; padding-left: 5px; padding-right: 5px; background: #5F9EA0; color: #FFFFFF; margin-left: 10%;" href="{{ $url }}">Click here to view all timetables</a>