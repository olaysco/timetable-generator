<?php

namespace App\Services;

use App\Models\Timeslot;

class TimeslotsService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Timeslot
     */
    protected $model = Timeslot::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;
}