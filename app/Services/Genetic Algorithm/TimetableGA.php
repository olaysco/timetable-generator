<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\Course;
use App\Models\Room as RoomModel;
use App\Models\Timetable as TimetableModel;
use App\Models\Timeslot as TimeslotModel;

class TimetableGA
{
    /**
     * Timetable we want to run the algorithm for
     *
     * @var App\Models\Timetable
     */
    protected $timetable;

    /**
     * Create a new instance of TimetableGA class
     *
     * @param App\Models\Timetable $timetable Timetable we want to run the algorithm
     *                                        to generate
     */
    public function __construct(App\Models\TimetableModel $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Create the data for the algorithm
     *
     */
    public function initializeTimetable()
    {
        $maxContinuousSlots = 1;
        $timetable = new Timetable($maxContinuousSlots);

        // Set up rooms for the GA data using rooms data from DB
        $rooms = RoomModel::all();

        foreach ($rooms as $room) {
            $timetable->addRoom($room->id);
        }

        // Set up timeslots
        $days = $this->timetable->days;
        $timeslots = TimeslotModel::all();
        $count = 1;

        foreach ($days as $day) {
            foreach ($timeslots as $timeslot) {
                $timeslotId = 'D'.$day->id . "T" . $timeslot->id;
                $nextTimeslotId = $this->getNextTimeslotId($day, $timeslot);
                $timetable->addTimeslot($timeslotId, $nextTimeslotId);
            }
        }

        // Set up professors
        $professors = ProfessorModel::all();

        foreach ($professors as $professor) {
            $unavailableSlotIds = [];

            foreach ($professor->unavailable_timeslots as $timeslot) {
                $unavailableSlotIds[] = 'D' . $timeslot->day_id . 'T' . $timeslot->timeslot_id;
            }

            $timetable->addProfessor($professor->id, $unavailableTimeslots);
        }

        // Set up courses
        $courses = Course::all();

        foreach ($courses as $course) {
            $professorIds  = [];

            foreach ($course->professors as $professor) {
                $professorIds[] = $professor->id;
            }

            $timetable->addModule($course->id, $professorIds);
        }

        return $timetable;
    }


    /**
     * Get the id of the next timeslot after the one given
     *
     */
    public function getNextTimeslotId($day, $timeslot)
    {
        $highestRank = TimeslotModel::count();
        $currentRank = (int)($timeslot->rank);
        $id = '';
        $endId = 'D0T0';

        if (($currentRank + 1) <= $highestRank) {
            $nextTimeslot = TimeslotModel::where('rank', ($currentRank + 1))->first();

            if ($nextTimeslot) {
                $id = 'D' . $day->id  . 'T' . $nexTimeslot->id;
            } else {
                $id = $endId;
            }
        } else {
            $id = $endId;
        }

        return $endId;
    }
}