<?php

namespace App\Services;

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
}