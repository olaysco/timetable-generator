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
            'name' => $data['name'],
            'email' => $data['email']
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

    /**
     * Get the professor with the given id
     *
     * @param int $id The Id of the professor
     */
    public function show($id)
    {
        $professor = Professor::find($id);
        $courseIds = [];
        $periods = [];

        if (!$professor) {
            return null;
        }

        foreach ($professor->courses as $course) {
            $courseIds[] = $course->id;
        }

        foreach ($professor->unavailable_timeslots as $period) {
            $periods[] = implode(",", [$period->day_id, $period->timeslot_id]);
        }

        $professor->course_ids = $courseIds;
        $professor->periods = $periods;

        return $professor;
    }

    /**
     * Update the professor with the given id
     * with new data
     *
     * @param int $id The id of the professor
     * @param array $data Data for update
     */
    public function update($id, $data = [])
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return null;
        }

        $professor->update([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        if (!isset($data['course_ids'])) {
            $data['course_ids'] = [];
        }

        $professor->courses()->sync($data['course_ids']);

        if (isset($data['unavailable_periods'])) {
            foreach ($data['unavailable_periods'] as $period) {
                $parts = explode("," , $period);
                $dayId = $parts[0];
                $timeslotId = $parts[1];

                $existing = $professor->unavailable_timeslots()
                    ->where('day_id', $dayId)
                    ->where('timeslot_id', $timeslotId)
                    ->first();

                if (!$existing) {
                    $professor->unavailable_timeslots()->create([
                        'day_id' => $dayId,
                        'timeslot_id' => $timeslotId
                    ]);
                }
            }

            foreach ($professor->unavailable_timeslots as $period) {
                if ($period->day && $period->timeslot) {
                    $periodString = implode("," , [$period->day->id, $period->timeslot->id]);
                }

                if (!isset($data['unavailable_periods']) || !in_array($periodString, $data['unavailable_periods'])) {
                    $period->delete();
                }
            }
        } else {
            foreach ($professor->unavailable_timeslots as $period) {
                $period->delete();
            }
        }

        return $professor;
    }
}