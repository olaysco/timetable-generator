<?php

namespace App\Models;

class Timetable extends Model
{
    /**
     * Table used by this model
     *
     * @var string
     */
    protected $table = 'timetables';

    /**
     * Non mass assignable fields
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Days used by this timetable
     *
     * @return App\Models\Day
     */
    public function days()
    {
        return $this->belongsToMany(Day::class, 'timetable_days', 'timetable_id', 'day_id');
    }

    /**
     * Schedules for professors created out of this timetable
     */
    public function schedules()
    {
        return $this->hasMany(ProfessorSchedule::class, 'timetable_id');
    }
}
