<?php

namespace App\Services\GeneticAlgorithm;

use Storage;

use App\Models\Day;
use App\Models\Timeslot;

class TimetableRenderer
{
    /**
     * Create a new instance of this class
     *
     * @param App\Models\Timetable Timetable whose data we are rendering
     */
    public function __construct($timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Generate HTML layout files out of the timetable data
     *
     * Chromosome interpretation is as follows
     * Timeslot, Room, Professor
     *
     */
    public function render()
    {
        $chromosome = explode(",", $this->timetable->chromosome);
        $data = $this->generateData($chromosome);

        Storage::put('storage/timetables/timetable_' . $this->timetable->id . '.html', 'Hello World');
    }

    /**
     * Get an associative array with data for constructing timetable
     *
     * @param string $chromosome Timetable chromosome
     * @return array Timetable data
     */
    public function generateData($chromosome)
    {
        $data = [];
        \Log::info(count($chromosome));
        for ($i = 0; $i < count($chromosome); $i += 3) {
            $timeslotGene = $chromosome[$i];
            $roomGene = $chromosome[$i + 1];
            $professorGene = $chromosome[$i + 2];

            $matches = [];
            preg_match('/D(\d*)T(\d*)/', $timeslotId, $matches);

            $dayId = $matches[1];
            $timeslotId = $matches[2];

            $day = Day::find($dayId);
            $timeslot = Timeslot::find($timeslotId);
            $professor = Professor::find($professorGene);
            $room = Room::find($roomGene);

            if (!isset($day->name)) {
                $data[$day->name] = [];
            }

            if (!isset($data[$day->name][$timeslot->time])) {
                $data[$day->name][$timeslot->time] = [];
            }

            $data[$day->name][$timeslot->time]['course'] =>
        }
    }
}