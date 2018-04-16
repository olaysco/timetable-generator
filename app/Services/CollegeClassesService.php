<?php

namespace App\Services;

use DB;
use App\Models\CollegeClass;

class CollegeClassesService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\CollegeClass
     */
    protected $model = CollegeClass::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;

    protected $customFilters = [
        'no_course' => 'getClassesWithNoCourse'
    ];

    /**
     * Get a listing of college classes with necessary filtering
     * applied
     *
     */
    public function all($data = [])
    {
        $classes = parent::all($data);

        return $classes;
    }

    /**
     * Add a new college class
     *
     * @param array $data Data for creating a new college class
     * @return App\Models\CollegeClass Newly created class
     */
    public function store($data = [])
    {
        $class = CollegeClass::create([
            'name' => $data['name'],
            'size' => $data['size']
        ]);

        if (!$class) {
            return null;
        }

        $class->unavailable_rooms()->sync($data['unavailable_rooms']);
        $class->courses()->sync($data['courses']);

        return $class;
    }

    /**
     * Get class with given id
     *
     * @param int $id The class' id
     */
    public function show($id)
    {
        $class = parent::show($id);

        if (!$class) {
            return null;
        }

        $roomIds = [];

        foreach ($class->unavailable_rooms as $room) {
            $roomIds[] = $room->id;
        }

        $class->room_ids = $roomIds;

        return $class;
    }

    /**
     * Update the class with the given id
     *
     * @param int $id The ID of the class
     * @param array $data Data
     */
    public function update($id, $data = [])
    {
        $class = CollegeClass::find($id);

        if (!$class) {
            return null;
        }

        $class->update([
            'name' => $data['name'],
            'size' => $data['size']
        ]);

        if (!isset($data['unavailable_rooms'])) {
            $data['unavailable_rooms'] = [];
        }

        if (!isset($data['courses'])) {
            $data['courses'] = [];
        }

        $class->unavailable_rooms()->sync($data['unavailable_rooms']);
        $class->courses()->sync($data['courses']);

        return $class;
    }

    /**
     * Return query with filter applied to select classes with no course added for them
     */
    public function getClassesWithNoCourse($query)
    {
        return $query->havingNoCourses();
    }
}