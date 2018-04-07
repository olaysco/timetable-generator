<?php

namespace App\Models;

class Day extends Model
{
    /**
     * DB table that this model uses
     *
     * @var string
     */
    protected $table = 'days';

    /**
     * Get timeslots for this day
     */
    public function timeslots()
    {
        return $this->hasMany(Timeslot::class, 'day_id');
    }
}
