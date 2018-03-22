<?php

namespace App\Services;

use App\Models\Room;

class RoomsService extends AbstractService
{
    /*
     * The model to be used by this service.
     *
     * @var \App\Models\Room
     */
    protected $model = Room::class;

    /**
     * Show resources with their relations.
     *
     * @var bool
     */
    protected $showWithRelations = true;
}