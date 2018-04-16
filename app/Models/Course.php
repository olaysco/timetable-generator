<?php

namespace App\Models;

use DB;
class Course extends Model
{
    /**
     * The DB table used by this model
     *
     * @var string
     */
    protected $table = 'courses';

    /**
     * The fields that should not be mass assigned
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Relations of this model
     *
     * @var array
     */
    protected $relations = ['professors', 'classes'];

    /**
     * Fields that a keyword search should be carried on
     *
     * @var array
     */
    protected $searchFields = ['name', 'course_code'];

    /**
     * Declare a relationship between this course and the
     * professors that teach it
     *
     * @return Illuminate\Database\Eloquent
     */
    public function professors()
    {
        return $this->belongsToMany(Professor::class, 'courses_professors', 'course_id', 'professor_id');
    }

    /**
     * Declare a relationship between this course and the classes
     * that offer it
     *
     * @return Illuminate\Database\Eloquent
     */
    public function classes()
    {
        return $this->belongsToMany(CollegeClass::class, 'courses_classes', 'course_id', 'class_id');
    }


    /**
     * Get courses with no professors set up for them
     *
     */
    public function scopeHavingNoProfessors($query)
    {
        return $query->has('professors', '<', 1);
    }
}
