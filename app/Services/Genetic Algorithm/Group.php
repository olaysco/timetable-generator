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
}