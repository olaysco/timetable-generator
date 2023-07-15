<?php
namespace App\Services\GeneticAlgorithm;

class Individual
{
    /**
     * This is the genetic makeup of an individual
     *
     * @var array
     */
    private $chromosome;


    /**
     * Fitness of the individual
     *
     * @var double
     */
    private $fitness;


    /**
     * Create a new individual from a timetable
     *
     * @var Timetable The timetable
     */
    public function __construct($timetable = null)
    {
        if ($timetable) {
            $newChromosome = [];

            $chromosomeIndex = 0;

            foreach ($timetable->getGroups() as $group) {
                foreach ($group->getModuleIds() as $moduleId) {
                    $module = $timetable->getModule($moduleId);
                    //print "\nOn Module " . $module->getModuleCode() . "\n";

                    for ($i = 1; $i <= $module->getSlots($group->getId()); $i++) {
                        // Add random time slot
                        $timeslotId = $timetable->getRandomTimeslot()->getId();
                        $newChromosome[$chromosomeIndex] = $timeslotId;
                        $chromosomeIndex++;

                        // Add random room
                        $roomId = $timetable->getRandomRoom()->getId();
                        $newChromosome[$chromosomeIndex] = $roomId;
                        $chromosomeIndex++;

                        // Add random professor
                        $professor = $module->getRandomProfessorId();
                        $newChromosome[$chromosomeIndex] = $professor;
                        $chromosomeIndex++;

                        $module->increaseAllocatedSlots();
                        $timeslot = $timetable->getTimeslot($timeslotId);

                        $timeslotId = $timeslot->getNext();
                        while (($i + 1) <= $timetable->maxContinuousSlots && ($module->getSlots() != $module->getAllocatedSlots()) && ($timeslotId > -1)) {
                            $newChromosome[$chromosomeIndex] = $timeslotId;
                            $chromosomeIndex++;

                            $newChromosome[$chromosomeIndex] = $roomId;
                            $chromosomeIndex++;

                            $newChromosome[$chromosomeIndex] = $professor;
                            $chromosomeIndex++;

                            $timeslotId = $timetable->getTimeslot($timeslotId)->getNext();
                            $module->increaseAllocatedSlots();
                            $i += 1;
                        }
                    }
                }
            }

            foreach ($timetable->getModules() as $module) {
                $module->resetAllocated();
            }
        } else {
            $newChromosome = [];
        }

        $this->chromosome = $newChromosome;
    }

    /**
     * Create a new individual with a randomised chromosome
     *
     * @param int $chromosomeLength Desired chromosome length
     */
    public static function random($chromosomeLength)
    {
        $individual = new Individual();

        for ($i = 0; $i < $chromosomeLength; $i++) {
            $individual->setGene($i, mt_rand(0, 1));
        }

        return $individual;
    }

    /**
     * Get the individual's chromosome
     *
     * @return array The chromosome
     */
    public function getChromosome()
    {
        return $this->chromosome;
    }

    /**
     * Get the length of the individual's chromosome
     *
     * @return int The length
     */
    public function getChromosomeLength()
    {
        return count($this->chromosome);
    }

    /**
     * Fix a gene at the given location of the chromosome
     *
     * @param int $index The location to insert the gene
     * @param int $gene The gene
     */
    public function setGene($index, $gene)
    {
        $this->chromosome[$index] = $gene;
    }

    /**
     * Get the gene at the specified location
     *
     * @param $index The location to get the gene at
     * @return int The bit representing the gene at that location
     */
    public function getGene($index)
    {
        return $this->chromosome[$index];
    }

    /**
     * Set the fitness param for this individual
     *
     * @param double $fitness The fitness of this individual
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    /**
     * Get the fitness for this individual
     *
     * @return double The fitness of the individual
     */
    public function getFitness()
    {
        return $this->fitness;
    }

    /**
     * Get a printout of the individual
     *
     * @return string Output of the individual details
     */
    public function __toString()
    {
        return $this->getChromosomeString();
    }

    public function getChromosomeString()
    {
        return implode(",", $this->chromosome);
    }
}