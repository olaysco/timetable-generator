<?php

namespace App\Models;

class Room extends Model
{
    /**
     * DB table this model uses
     *
     * @var string
     */
    protected $table = 'rooms';

    /**
     * Fields to be protected from mass assignment
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Declare a relationship between this room and the courses
     * that are allowed to use this room
     *
     * @return Illuminate\Database\Eloquent
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'favourite_rooms', 'room_id', 'course_id');
    }
}
