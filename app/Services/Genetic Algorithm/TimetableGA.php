<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\Course;
use App\Models\Room as RoomModel;
use App\Models\Timeslot as TimeslotModel;
use App\Models\Timetable as TimetableModel;
use App\Models\Professor as ProfessorModel;
use App\Models\CollegeClass as CollegeClassModel;

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
    public function __construct(TimetableModel $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Create the problem instance for the algorithm
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

            $timetable->addProfessor($professor->id, $unavailableSlotIds);
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

        // Set up class groups
        $classes = CollegeClassModel::all();

        foreach ($classes as $class) {
            $courseIds = [];

            foreach ($class->courses as $course) {
                $courseIds[] = $course->id;
            }

            $timetable->addGroup($class->id, $courseIds);
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
                $id = 'D' . $day->id  . 'T' . $nextTimeslot->id;
            } else {
                $id = $endId;
            }
        } else {
            $id = $endId;
        }

        return $id;
    }

    /**
     * Run the timetable generation algorithm
     *
     */
    public function run()
    {
        $maxGenerations = 1500;

        $timetable = $this->initializeTimetable();

        $algorithm = new GeneticAlgorithm(100, 0.01, 0.9, 2, 10);

        $population = $algorithm->initPopulation($timetable);

        $algorithm->evaluatePopulation($population, $timetable);

        // Keep track of current generation
        $generation = 1;

        while (!$algorithm->isTerminationConditionMet($population)
            && !$algorithm->isGenerationsMaxedOut($generation, $maxGenerations)) {
            $fittest = $population->getFittest(0);

            print "Generation: " . $generation . "(" . $fittest->getFitness() . ") - ";
            print $fittest;
            print "\n";

            // Apply crossover
            $population = $algorithm->crossoverPopulation($population);

            // Apply mutation
            $population = $algorithm->mutatePopulation($population, $timetable);

            // Evaluate Population
            $algorithm->evaluatePopulation($population, $timetable);

            // Increment current
            $generation++;

            // Cool temperature of GA for simulated annealing
            $algorithm->coolTemperature();
        }

        $timetable->createClasses($population->getFittest(0));

        print "Solution found in {$generation} generations\n";
        print "Final solution fitness: " . $population->getFittest(0)->getFitness() . "\n";
        print "Clashes: " . $timetable->calcClashes() . "";

        $classes = $timetable->getClasses();

        $classes = $timetable->getClasses();
        $printOut = [];
        //print_r($classes);
        //return;

        foreach ($timetable->getGroups() as $group) {
            $printOut[$group->getId()] = [];

            foreach ($timetable->getTimeslots() as $slot) {
                $day = substr($slot->getTimeslot(), 0, 3);
                $time = substr($slot->getTimeslot(), 4);
                $printOut[$group->getId()][$day][$time] = "";
            }
        }

        foreach ($classes as $class) {
            $groupId = $timetable->getGroup($class->getGroupId())->getId();
            $timeSlot = $timetable->getTimeslot($class->getTimeslotId())->getTimeslot();
            $professor = $timetable->getProfessor($class->getProfessorId())->getName();
            $module = $timetable->getModule($class->getModuleId())->getModuleCode();
            $room = $timetable->getRoom($class->getRoomId())->getRoomNumber();
            $day = substr($timeSlot, 0, 3);
            $time = substr($timeSlot, 4);

            $printOut[$groupId][$day][$time] = $module . " - " . $professor . " - " . $room;
        }

        foreach ($printOut as $groupId => $data) {
            print "\n\nYear " . $groupId ."\n";
            printf("%'-140s\n", "");
            foreach ($data as $day => $dayData) {
                print $day . " | \t";
                foreach ($dayData as $time => $info) {
                    printf( "%-30s", $info);
                    print " | ";
                }
                printf("\n%'-140s\n", "");
            }
        }
    }
}