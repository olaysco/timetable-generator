<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\CollegeClass as CollegeClassModel;
class Group
{
    /**
     * ID of group
     *
     * @var int
     */
    private $id;

    /**
     * College class model
     *
     * @var App\Models\CollegeClass
     */
    private $model;

    /**
     * IDs of modules taken by this group
     *
     * @var array
     */
    private $moduleIds;

    /**
     * IDs of rooms not available to this class
     *
     * @var array
     */
    private $unavailableRooms;

    /**
     * Instantiate a new group
     *
     * @param int $id Id of group
     * @param array Ids of modules taken by this group
     */
    public function __construct($id,  $moduleIds)
    {
        $this->id = $id;
        $this->model = CollegeClassModel::find($id);
        $this->moduleIds = $moduleIds;
        $this->unavailableRooms = [];

        foreach ($this->model->unavailable_rooms as $room) {
            $this->unavailableRooms[] = $room->id;
        }
    }

    /**
     * Get the Id of the group
     *
     * @return int Id of group
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the size of this group
     *
     * @return int Size of group
     */
    public function getSize()
    {
        return $this->model->size;
    }

    /**
     * Get the IDs of modules this group is taking
     *
     * @return array Module Ids
     */
    public function getModuleIds()
    {
        return $this->moduleIds;
    }

    /**
     * Get unavailable rooms
     *
     * @return array Ids of rooms not available to this group
     */
    public function getUnavailableRooms()
    {
        return $this->unavailableRooms;
    }
}