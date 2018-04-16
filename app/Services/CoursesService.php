<?php

namespace App\Services;

use DB;
use App\Models\Course;

class CoursesService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Course
     */
    protected $model = Course::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;

    protected $customFilters = [
        'no_professor' => 'getCoursesWithNoProfessors'
    ];

    /**
     * Save a new course in the db
     *
     * @param array $data Data for creating a new course
     */
    public function store($data = [])
    {
        $course = Course::create([
            'name' => $data['name'],
            'course_code' => $data['course_code']
        ]);

        if (!$course) {
            return null;
        }

        if (!isset($data['professor_ids'])) {
            $data['professor_ids'] = [];
        }

        $course->professors()->sync($data['professor_ids']);

        return $course;
    }

    /**
     * Get the course with the given id loaded with necessary data
     *
     * @param int $id Id of professor
     * @return App\Models\Course Newly created course
     */
    public function show($id)
    {
        $course = Course::find($id);
        $professorIds = [];

        if (!$course) {
            return null;
        }

        foreach ($course->professors as $professor) {
            $professorIds[] = $professor->id;
        }

        $course->professor_ids = $professorIds;

        return $course;
    }

    /**
     * Update the course with the given data
     *
     * @param int $id Id of course
     * @param array $data Data for updating course
     * @return App\Models\Course The updated course
     */
    public function update($id, $data = [])
    {
        $course = Course::find($id);

        if (!$course) {
            return null;
        }

        $course->update([
            'name' => $data['name'],
            'course_code' => $data['course_code']
        ]);

        if (!isset($data['professor_ids'])) {
            $data['professor_ids'] = [];
        }


        $course->professors()->sync($data['professor_ids']);

        return $course;
    }

    /**
     * Return query with filter applied to select courses with no professor added for them
     */
    public function getCoursesWithNoProfessors($query)
    {
        return $query->havingNoProfessors();
    }
}