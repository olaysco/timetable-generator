<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    /**
     * DB table this model uses
     * 
     * @var string
     */
    protected $table = 'professors';

    /**
     * Declare relationship between a professor and the courses
     * he or she teaches
     * 
     * @return Illuminate\Database\Eloquent
     */
    public function courses()
    {
        return $this->belongsToMany(Professor::class, 'courses_professors', 'professor_id', 'course_id');
    }

    /**
     * Declare relationship between a professor and the timeslots that he or she
     * is not available
     * 
     * @return Illuminate\Database\Eloquent
     */
    public function unavailable_timeslots()
    {
        return $this->hasMany(Timeslot::class, 'unavailable_timeslots', 'professor_id', 'timeslot_id');
    }
}
