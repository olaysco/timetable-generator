<?php
namespace App\Services\GeneticAlgorithm;

class Timetable
{
    /**
     * Rooms indexed by their IDs
     *
     * @var array
     */
    private $rooms;

    /**
     * Collection of professors indexed by their IDs
     *
     * @var array
     */
    private $professors;

    /**
     * Collection of modules indexed by their IDs
     *
     * @var array
     */
    private $modules;

    /**
     * Collection of class groups indexed by their IDs
     *
     * @var array
     */
    private $groups;

    /**
     * Collection of time slots
     *
     * @var array
     */
    private $timeslots;

    /**
     * Number of classes scheduled
     *
     * @var int
     */
    private $numClasses;

    /**
     * Maximum slots students can have continuously
     *
     * @var int
     */
    public $maxContinuousSlots;

    /**
     * Create a new instance of this class
     */
    public function __construct($maxContinuousSlots)
    {
        $this->rooms = [];
        $this->professors = [];
        $this->modules = [];
        $this->groups = [];
        $this->timeslots = [];
        $this->numClasses = 0;
        $this->maxContinuousSlots = $maxContinuousSlots;
    }

    /**
     * Get the groups
     *
     * @return array The groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Get the timeslots
     *
     * @return array The timeslots
     */
    public function getTimeslots()
    {
        return $this->timeslots;
    }

    /**
     * Get the modules
     *
     * @return array The modules
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * Get the professors
     *
     * @return array Collection of professors
     */
    public function getProfessors()
    {
        return $this->professors;
    }

    /**
     * Add a new lecture room
     *
     * @param int $roomId ID of room
     * @param string $roomName Name of room
     * @param int $roomCapacity Capacity of room
     */
    public function addRoom($roomId, $roomName, $roomCapacity)
    {
        $this->rooms[$roomId] = new Room($roomId, $roomName, $roomCapacity);
    }

    /**
     * Add a professor
     *
     * @param int $professorId Id of professor
     * @param string $professorName Name of professor
     * @param string $unavailableSlots Slots that the professor can't teach
     */
    public function addProfessor($professorId, $professorName, $unavailableSlots)
    {
        $this->professors[$professorId] = new Professor($professorId, $professorName, $unavailableSlots);
    }

    /**
     * Add a new module
     *
     * @param int $moduleId Id of module
     * @param string $moduleCode Module Code
     * @param string $moduleName Name of module
     * @param array $professorIds Ids of professors
     * @param int $slots Number of slots this course should take
     */
    public function addModule($moduleId, $moduleCode, $moduleName, $professorIds, $slots)
    {
        $this->modules[$moduleId] = new Module($moduleId, $moduleCode, $moduleName, $professorIds, $slots);
    }

    /**
     * Add a group to this timetable
     *
     * @param int $groupId ID of group
     * @param int $groupSize Size of the group
     * @param array $moduleIds IDs of modules
     */
    public function addGroup($groupId, $groupSize, $moduleIds)
    {
        $this->groups[$groupId] = new Group($groupId, $groupSize, $moduleIds);
        $this->numClasses = 0;
    }

    /**
     * Add a new timeslot
     *
     * @param int $timeslotId ID of time slot
     * @param string $timeslot Timeslot
     */
    public function addTimeslot($timeslotId, $timeslot, $next)
    {
        $this->timeslots[$timeslotId] = new Timeslot($timeslotId, $timeslot, $next);
    }

    /**
     * Create classes using individual's chromosomes
     *
     * @param Individual $individual Individual
     */
    public function createClasses($individual)
    {
        $classes = [];

        $chromosome = $individual->getChromosome();
        $chromosomePos = 0;
        $classIndex = 0;

        foreach ($this->groups as $id => $group) {
            $moduleIds = $group->getModuleIds();

            foreach ($moduleIds as $moduleId) {
                $module = $this->getModule($moduleId);

                for ($i = 1; $i <= $module->getSlots(); $i++) {
                    $classes[$classIndex] = new CollegeClass($classIndex, $group->getId(), $moduleId);

                    // Add timeslot
                    $classes[$classIndex]->addTimeslot($chromosome[$chromosomePos]);
                    $chromosomePos++;

                    // Add room
                    $classes[$classIndex]->addRoom($chromosome[$chromosomePos]);
                    $chromosomePos++;

                    // Add professor
                    $classes[$classIndex]->addProfessor($chromosome[$chromosomePos]);
                    $chromosomePos++;

                    $classIndex++;
                }
            }
        }

        $this->classes = $classes;
    }

    /**
     * Get a room by ID
     *
     * @param int $roomId ID of room
     */
    public function getRoom($roomId)
    {
        if (!isset($this->rooms[$roomId])) {
            print "No room with ID " . $roomId;
            return null;
        }

        return $this->rooms[$roomId];
    }

    /**
     * Get all rooms
     *
     * @return array Collection of rooms
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Get a random room
     *
     * @return Room room
     */
    public function getRandomRoom() {
        return $this->rooms[array_rand($this->rooms)];
    }

    /**
     * Get professor with given ID
     *
     * @param int $professorId ID of professor
     */
    public function getProfessor($professorId)
    {
        return $this->professors[$professorId];
    }

    /**
     * Get module by Id
     *
     * @param int $moduleId ID of module
     */
    public function getModule($moduleId)
    {
        return $this->modules[$moduleId];
    }

    /**
     * Get modules of a student group with given ID
     *
     * @param int $groupId ID of group
     */
    public function getGroupModules($groupId)
    {
        $group = $this->groups[$groupId];
        return $group->getModuleIds();
    }

    /**
     * Get a group using its group ID
     *
     * @param int $groupId ID of group
     * @return Group A group
     */
    public function getGroup($groupId)
    {
        return $this->groups[$groupId];
    }

    /**
     * Get timeslot with given ID
     *
     * @param int $timeslotId ID Of timeslot
     * @return Timeslot A timeslot
     */
    public function getTimeslot($timeslotId)
    {
        return $this->timeslots[$timeslotId];
    }

    /**
     * Get a random time slot
     *
     * @return Timeslot A timeslot
     */
    public function getRandomTimeslot()
    {
        return $this->timeslots[array_rand($this->timeslots)];
    }

    /**
     * Get a collection of classes
     *
     * @return array Classes
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Get number of classes that need scheduling
     *
     * @return int Number of classes
     */
    public function getNumClasses()
    {
        if ($this->numClasses > 0) {
            return $this->numClasses;
        }

        $numClasses = 0;

        foreach ($this->groups as $group) {
            $numClasses += count($group->getModuleIds());
        }

        $this->numClasses = $numClasses;
        return $numClasses;
    }

    /**
     * Get classes scheduled for a given day for a given group
     *
     * @param $day Day we are getting classes for
     * @param $groupId The ID of the group
     */
    public function getClassesByDay($day, $groupId)
    {
        $classes = [];

        foreach ($this->classes as $class) {
            $timeslot = $this->getTimeslot($class->getTimeslotId());

            $classDay = trim(explode(" ", $timeslot->getTimeslot())[0]);

            if ($day == $classDay && $class->getGroupId() == $groupId) {
                $classes[] = $class;
            }
        }

        return $classes;
    }

    /**
     * Calculate the number of clashes
     *
     * @return $numClashes Number of clashes
     */
    public function calcClashes()
    {
        $clashes = 0;
        $days = ["Mon", "Tue", "Wed", "Thu", "Fri"];

        foreach ($this->classes as $id => $classA) {
            $roomCapacity = $this->getRoom($classA->getRoomId())->getCapacity();
            $groupSize = $this->getGroup($classA->getGroupId())->getSize();
            $professor = $this->getProfessor($classA->getProfessorId());
            $timeslot = $this->getTimeslot($classA->getTimeslotId());
            $module = $this->getModule($classA->getModuleId());

            // Check room capacity
            $roomCapacity = $this->getRoom($classA->getRoomId())->getCapacity();
            $groupSize = $this->getGroup($classA->getGroupId())->getSize();
            $professor = $this->getProfessor($classA->getProfessorId());
            $timeslot = $this->getTimeslot($classA->getTimeslotId());
            $module = $this->getModule($classA->getModuleId());

            if ($roomCapacity < $groupSize) {
                $clashes++;
            }

            // Check if we don't have any lecturer forced to teach at his occupied time
            if (in_array($timeslot->getId(), $professor->getOccupiedSlots())) {
                $clashes++;
            }

            // Check if room is taken
            foreach ($this->classes as $id => $classB) {
                if ($classA->getId() != $classB->getId()) {
                    if (($classA->getRoomId() == $classB->getRoomId()) && ($classA->getTimeslotId() == $classB->getTimeslotId())) {
                        $clashes++;
                        break;
                    }
                }
            }

            // Check if professor is available
            foreach ($this->classes as $id => $classB) {
                if ($classA->getId() != $classB->getId()) {
                    if (($classA->getProfessorId() == $classB->getProfessorId())
                        && ($classA->getTimeslotId() == $classB->getTimeslotId())) {
                            $clashes++;
                            break;
                    }
                }
            }

            // Check if we don't have same group in two classes at same time
            foreach ($this->classes as $id => $classB) {
                if ($classA->getId() != $classB->getId()) {
                    if (($classA->getGroupId() == $classB->getGroupId()) && ($classA->getTimeslotId() == $classB->getTimeslotId())) {
                        $clashes++;
                        break;
                    }
                }
            }
        }

        // Constraint to ensure that no course occurs at two different locations
        // and or at non-consecutive time slots
        foreach ($days as $day) {
            foreach ($this->getGroups() as $group) {
                $classes = $this->getClassesByDay($day, $group->getId());
                $checkedModules = [];

                foreach ($classes as $classA) {
                    if (!in_array($classA->getModuleId(), $checkedModules)) {
                        $moduleTimeslots = [];

                        foreach ($classes as $classB) {
                            if ($classA->getModuleId() == $classB->getModuleId()) {
                                if ($classA->getRoomId() != $classB->getRoomId()) {
                                    $clashes++;
                                }

                                $moduleTimeslots[] = $classB->getTimeslotId();
                            }
                        }

                        if (!areConsecutive($moduleTimeslots)) {
                            $clashes++;
                        }

                        $checkedModules[] = $classA->getModuleId();
                    }
                }
            }
        }

        return $clashes;
    }
}