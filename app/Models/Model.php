<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * Make almost all fields mass unsignable
     * 
     * @var array
     */
    protected $guarded = [];

    /**
     * Relations of this model
     * 
     * @var array
     */
    protected $relations = [];

    /**
     * Get the relations of this model
     * 
     * @return array Relations of this model
     */
    public function getRelations()
    {
        return $this->relations;
    }
}