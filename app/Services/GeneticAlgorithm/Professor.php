<?php
namespace App\Services\GeneticAlgorithm;

use App\Models\Professor as ProfessorModel;

class Professor
{
    /**
     * ID of professor
     *
     * @var int
     */
    private $id;

    /**
     * Professor model from db
     *
     * @var App\Models\Professor
     */
    private $professorModel;

    /**
     * Create a new professor
     *
     * @param int $id ID of professor
     * @param array $occupiedSlots Timeslots that the professor is not available
     */
    public function __construct($id, $occupiedSlots)
    {
        $this->id = $id;
        $this->professorModel = ProfessorModel::find($this->id);
        $this->occupiedSlots = $occupiedSlots;
    }

    /**
     * Get ID Of professor
     *
     * @return int ID Of professor
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name of professor
     *
     * @return string Name of professor
     */
    public function getName()
    {
        return $this->professorModel->name;
    }

    public function getOccupiedSlots()
    {
        return $this->occupiedSlots;
    }
}