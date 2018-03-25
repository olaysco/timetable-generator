<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $table = 'timeslots';

    protected $guarded = ['id'];

    /**
     * Generate a time period string
     *
     * @param string $from From section of period
     * @param string $to   To section of period
     */
    public static function createTimePeriod($from, $to)
    {
        return $from . ' - ' . $to;
    }
}
