<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
