<?php
namespace App\Services;

use DB;

use App\Models\Course;
use App\Models\Timetable;
use App\Models\Professor;
use App\Models\CollegeClass;


class TimetableService
{
    /**
     * Check that everything is intact to create a timetable set
     * Return errors from check
     *
     * @return array Errors from check
     */
    public function checkCreationConditions()
    {
        $errors = [];

        $coursesQuery = 'SELECT id FROM courses WHERE id NOT IN (SELECT DISTINCT course_id FROM courses_professors)';
        $courseIds = DB::select(DB::Raw($coursesQuery));

        if (count($courseIds)) {
            $errors[] = "Some courses don't have professors.<a href=\"/courses?filter=no_professor\" target=\"_blank\">Click here to review them</a>";
        }

        if (!CollegeClass::count()) {
            $errors[] = "No classes have been added";
        }

        $classesQuery = 'SELECT id FROM classes WHERE id NOT IN (SELECT DISTINCT class_id FROM courses_classes)';
        $classIds = DB::select(DB::Raw($classesQuery));

        if (count($classIds)) {
            $errors[] = "Some classes don't have any course set up.<a href=\"/classes?filter=no_course\" target=\"_blank\">Click here to review them</a>";
        }

        return $errors;
    }
}