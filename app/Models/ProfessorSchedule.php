<?php

namespace App\Models;


class ProfessorSchedule extends Model
{
    /**
     * Table for this model
     */
    protected $table = 'professor_schedules';

    /**
     * Fields protected from mass assignment
     */
    protected $guarded = ['id'];

    /**
     * Relations for this model
     */
    protected $relations = ['timetable', 'professor', 'course', 'day', 'timeslot', 'room', 'college_class'];

    /**
     * Timetable for this schedule
     */
    public function timetable()
    {
        return $this->belongsTo(Timetable::class, 'timetable_id');
    }

    /**
     * Course for this schedule
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * Professor for this schedule
     *
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }

    /**
     * Day for this schedule
     */
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    /**
     * Timeslot for this schedule
     */
    public function timeslot()
    {
        return $this->belongsTo(Timeslot::class, 'timeslot_id');
    }

    /**
     * Room for this schedule
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Class for this schedule
     */
    public function college_class()
    {
        return $this->belongsTo(CollegeClass::class, 'class_id');
    }
}
