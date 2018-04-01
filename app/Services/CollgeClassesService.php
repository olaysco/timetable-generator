<?php

namespace App\Services;

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
}