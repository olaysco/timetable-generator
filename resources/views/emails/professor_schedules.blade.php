<p>Based on the new timetables generated, your weekly schedule is as follows</p>

@foreach ($schedules as $day => $daySchedules)
    @foreach ($daySchedules as $schedule)
        <h3>{{ $day }}</h3>
        <p>{{ $schedule->timeslot->time }}</p>
        <p>{{ $schedule->course->course_code }} - {{ $schedule->course->name }}</p>
        <p>{{ $schedule->college_class->name }}</p>
        <p>{{ $schedule->room->name }}</p>
    @endforeach
@endforeach