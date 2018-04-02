<?php
namespace App\Services\GeneticAlgorithm;

class CollegeClass
{
    /**
     * Id of class
     *
     * @var int
     */
    private $id;

    /**
     * Id of group taking class
     *
     * @var int
     */
    private $groupId;

    /**
     * ID of module taken by this class
     *
     * @var int
     */
    private $moduleId;

    /**
     * ID of professor taking this class
     *
     * @var int ID of professor
     */
    private $professorId;

    /**
     * Id of timeslot this class is scheduled
     *
     * @var int
     */
    private $timeslotId;

    /**
     * Id of room
     *
     * @var int
     */
    private $roomId;

    /**
     * Create a new college class
     *
     * @param int $id Id of class group taking this class
     * @param int $groupId ID of group
     * @param int $moduleId ID of module taken by this class
     */
    public function __construct($id, $groupId, $moduleId)
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->moduleId = $moduleId;
    }

    /**
     * Set a professor for this class
     *
     * @param int $professorId Id of professor
     */
    public function addProfessor($professorId)
    {
        $this->professorId = $professorId;
    }

    /**
     * Allocate a timeslot for this class
     *
     * @param int ID of timeslot
     */
    public function addTimeSlot($timeslotId)
    {
        $this->timeslotId = $timeslotId;
    }

    /**
     * Allocate a room for this class
     *
     * @param int $roomId ID of the room
     */
    public function addRoom($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * Allocate a room to this class
     *
     * @param int $roomId ID of room for this class
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * Get the ID of this college class
     *
     * @return int ID of this class
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the id of group taking this class
     *
     * @return int ID of group taking this class
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Get the ID of module treated in this class
     *
     * @return int  ID Of module
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Get the id of professor taking this class
     *
     * @return int ID of professor
     */
    public function getProfessorId()
    {
        return $this->professorId;
    }

    /**
     * Get the time slot allocated to this class
     *
     * @return int Time slot ID
     */
    public function getTimeslotId()
    {
        return $this->timeslotId;
    }

    /**
     * Get the ID of the room allocated for this class
     *
     * @param int The room Id
     */
    public function getRoomId()
    {
        return $this->roomId;
    }
}