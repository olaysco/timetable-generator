<?php

namespace App\Models;

class CollegeClass extends Model
{
    /**
     * The DB table used by this model
     *
     * @var string
     */
    protected $table = 'classes';

    protected $guarded = ['id'];

    protected $relations = ['courses', 'unavailable_rooms'];

    /**
     * Get the rooms that are not available to this class
     */
    public function unavailable_rooms()
    {
        return $this->belongsToMany(Room::class, 'unavailable_rooms', 'class_id', 'room_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_classes', 'class_id', 'course_id')
            ->withPivot(['meetings', 'academic_period_id']);
    }

    /**
     * Get classes with no courses set up for them
     */
    public function scopeHavingNoCourses($query)
    {
        return $query->has('courses', '<', 1);
    }
}
