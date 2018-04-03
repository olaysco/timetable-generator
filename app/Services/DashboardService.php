<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Course;
use App\Models\Professor;
use App\Models\CollegeClass;

class DashboardService
{
    /**
     * Get data for display on the dashboard
     *
     * @return array Data
     */
    public function getData()
    {
        $roomsCount = Room::count();
        $coursesCount = Course::count();
        $professorsCount = Professor::count();
        $classesCount = CollegeClass::count();

        $data = [
            'cards' => [
                [
                    'title' => 'Lecture Rooms',
                    'icon' => 'home',
                    'value' => $roomsCount
                ],
                [
                    'title' => 'Courses',
                    'icon' => 'book',
                    'value' => $coursesCount
                ],
                [
                    'title' => 'Professors',
                    'icon' => 'graduation-cap',
                    'value' => $professorsCount
                ],
                [
                    'title' => 'Classes',
                    'icon' => 'users',
                    'value' => $classesCount
                ]
            ]
        ];

        return $data;
    }
}