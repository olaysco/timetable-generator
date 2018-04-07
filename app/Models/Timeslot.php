<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    protected $table = 'timeslots';

    protected $guarded = ['id'];

    /**
     * Determine whether a given period  is within
     * the period of this timeslot
     *
     * @param string $timePeriod The time period
     * @return Boolean Value of test
     */
    public function containsPeriod($timePeriod)
    {
        $edgesA = $this->getEdges($this->time);
        $edgesB = $this->getEdges($timePeriod);

        return (($edgesB[0] >= $edgesA[0]) && $edgesB[1] <= $edgesA[1]);
    }

    /**
     * Get the beginning and end of a given time period
     *
     * @param string $timePeriod Time period
     * @return array Beginning and end of given time period
     */
    public function getEdges($timePeriod)
    {
        preg_match('/(0?\d{1,2}):\d{2}\s*\-\s*(\d{2}):\d{2}/', $timePeriod, $matches);
        $begin = $matches[1];
        $end = $matches[2];

        return [$matches[1], $matches[2]];
    }

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
