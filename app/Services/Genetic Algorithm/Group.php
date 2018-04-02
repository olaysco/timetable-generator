<?php
namespace App\Services\GeneticAlgorithm;

class Group
{
    /**
     * ID of group
     *
     * @var int
     */
    private $id;

    /**
     * Size of group
     *
     * @var int
     */
    private $size;

    /**
     * IDs of modules taken by this group
     *
     * @var array
     */
    private $moduleIds;

    /**
     * Instantiate a new group
     *
     * @param int $id Id of group
     * @param int $size Size of the group
     * @param array Ids of modules taken by this group
     */
    public function __construct($id, $size, $moduleIds)
    {
        $this->id = $id;
        $this->size = $size;
        $this->moduleIds = $moduleIds;
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
        return $this->size;
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
}