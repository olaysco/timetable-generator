<?php

namespace App\Services;

use App\Models\Professor;

class ProfessorsService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Professor
     */
    protected $model = Professor::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;

    /**
     * Store a new professor in the DB
     *
     * @param array $data Data for creating professor
     */
    public function store($data = [])
    {
        $professor = Professor::create([
            'name' => $data['name']
        ]);

        if (!$professor) {
            return null;
        }

        if (isset($data['course_ids'])) {
            $professor->courses()->sync($data['course_ids']);
        }

        if (isset($data['unavailable_periods'])) {
            foreach ($data['unavailable_periods'] as $period) {
                $parts = explode("," , $period);
                $dayId = $parts[0];
                $periodId = $parts[1];

                $professor->unavailable_timeslots()->create([
                    'day_id' => $dayId,
                    'timeslot_id' => $periodId
                ]);
            }
        }

        return $professor;
    }
}