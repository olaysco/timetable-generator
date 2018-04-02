<?php
namespace App\Services\GeneticAlgorithm;

class Population
{
    /**
     * A collection of individuals
     *
     * @var array
     */
    private $population;

    /**
     * Fitness of population
     *
     * @var double
     */
    private $populationFitness;

    /**
     * Create a new population
     *
     * @param int $populationSize Size of population
     * @param Timetable $timetable Timetable for initializing individuals
     */
    public function __construct($populationSize = null, $timetable = null)
    {
        $this->population = [];

        if ($timetable) {
            for ($i = 0; $i < $populationSize; $i++) {
                $individual = new Individual($timetable);
                $this->population[$i] = $individual;
            }
        }
    }

    /**
     * Generate a random population of a given size
     * with each individual having given length of
     * chromosome
     *
     * @param int $populationSize Size of population
     * @param int $chromosomeLength Length of chromosome for each individual
     *
     */
    public static function random($populationSize, $chromosomeLength)
    {
        $population = new Population();

        for ($i = 0; $i < $populationSize; $i++) {
            $population->population[$i] = Individual::random($chromosomeLength);
        }

        return $population;
    }

    /**
     * Get the individuals in this population
     *
     * @return array A collection of individuals
     */
    public function getIndividuals()
    {
        return $this->population;
    }

    /**
     * Get the fittest individual in the population by a given index
     *
     * @param integer $index The index
     * @return Individual The individual
     */
    public function getFittest($index)
    {
        //print "Before:\n";
        //print $this;
        usort($this->population, function ($individualA, $individualB) {
            if ($individualA->getFitness() > $individualB->getFitness()) {
                return -1;
            } elseif ($individualB->getFitness() > $individualA->getFitness()) {
                return 1;
            }

            return 0;
        });
        //print "After:\n";
        //print $this;

        return $this->population[$index];
    }

    /**
     * Set the population fitness for this population
     *
     * @param double $fitness The fitness
     */
    public function setPopulationFitness($fitness)
    {
        $this->populationFitness = $fitness;
    }

    /**
     * Get the fitness of this population
     *
     * @return double The fitness of this population
     */
    public function getPopulationFitness()
    {
        return $this->populationFitness;
    }

    /**
     * Get the size of this population
     *
     * @return int The size of this population
     */
    public function size()
    {
        return count($this->population);
    }

    /**
     * Fix an individual at a given index of the population
     *
     * @param int  $index The index to fix individual
     * @param Individual $individual The individual
     */
    public function setIndividual($index, $individual)
    {
        $this->population[$index] = $individual;
    }

    /**
     * Get the individual at the given index
     *
     * @param int $index Desired index
     * @return Individual The individual
     */
    public function getIndividual($index)
    {
        return $this->population[$index];
    }

    /**
     * Shuffle the individuals of a population
     *
     */
    public function shuffle()
    {
        shuffle($this->population);
    }

    /**
     * Get the average of the fitness of individuals in this population
     *
     * @param double The average fitness
     */
    public function getAvgFitness()
    {
        if ($this->populationFitness == -1) {
            $totalFitness = 0;

            foreach ($this->population as $individual) {
                $totalFitness += $individual->getFitness();
            }

            $this->populationFitness = $totalFitness;
        }

        return $this->populationFitness / $this->size();
    }

    /**
     * Get a printout of the population
     *
     * @return string Output of the population details
     */
    public function __toString()
    {
        $output = "";

        for ($i = 0; $i < $this->size(); $i++) {
            $output .= $this->population[$i];
        }

        return $output;
    }
}