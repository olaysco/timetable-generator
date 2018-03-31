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
}