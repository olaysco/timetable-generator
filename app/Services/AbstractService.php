<?php

namespace App\Services;

use Schema;

abstract class AbstractService
{
    /**
     * The model to be used for this service.
     *
     * @var \App\Models\Model
     */
    protected $model;

    /**
     * Show the resource with all its relations
     *
     * @var bool
     */
    protected $showWithRelations = false;

    protected $customFilters = [];

    /**
     * Get all resources of this model
     *
     * @return \App\Models\Model
     */
    public function all($data = [])
    {
        $query = $this->model();

        // Deal with keyword searches
        if (isset($data['keyword'])) {
            $query = $this->search($query, $data['keyword']);
        }

        // Deal with ordering of resources.
        if (isset($data['order_by']) && $this->tableHasColumn($data['order_by'])) {
            $ranking = isset($data['ranking']) ? $data['ranking'] : 'asc';

            $query = $query->orderBy($data['order_by'], $this->getRanking($ranking));
        }

        // Load resources with their relations
        if ($this->showWithRelations()) {
            $query = $query->with($this->model()->getRelations());
        }

        // Pass query through functions for custom filtering
        if (isset($data['filter'])) {
            $func = $this->customFilters[$data['filter']];
            $query = $this->$func($query);
        }

        // Deal with pagination of resources.
        if (isset($data['paginate']) && $this->shouldPaginate($data['paginate'])) {
            $per_page = isset($data['per_page']) ? $data['per_page'] : null;

            return $query->paginate($this->getPerPage($per_page));
        }

        return $query->get();
    }

    /**
     * Store a new resource with the provided data.
     *
     * @param array $data
     * @return \App\Models\Model|null
     */
    public function store($data = [])
    {
        $data = $this->getValidData($data);

        if (count($data) < 1) {
            return null;
        }

        $resource = $this->model()->fill($data);
        $resource->save();

        return $resource;
    }

    /**
     * Show the specified resource. Load it with or without its relations
     * depending on the value of the showWithRelations variable.
     *
     * @param int $id
     * @return \App\Models\Model|null
     */
    public function show($id)
    {
        $resource = $this->find($id);

        if (!$resource) {
            return null;
        }

        return $this->showWithRelations() ? $resource->load($this->model()->getRelations()) : $resource;
    }

    /**
     * Update the specified resource with the specified data.
     * Returns null if the resource was not found or the data is not valid.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Model|null
     */
    public function update($id, $data = [])
    {
        $resource = $this->find($id);
        $data = $this->getValidData($data);

        if (!$resource || count($data) < 1 || !$resource->update($data)) {
            return null;
        }

        return $resource;
    }

    /**
     * Delete the resource with the specified id.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $resource = $this->find($id);

        if ($resource && $resource->delete()) {
            return true;
        }

        return false;
    }

    /**
     * Find a resource in the model using the specified
     * value and column for defining the constraints.
     *
     * @param mixed $value
     * @param string $column
     * @return \App\Models\Model|null
     */
    public function find($value, $column = 'id')
    {
        if ($this->tableHasColumn($column)) {
            return $this->model()->where($column, $value)->first();
        }

        return null;
    }

    /**
     * Get a new instance of the model used by this service.
     *
     * @return \App\Models\Model|null
     */
    protected function model()
    {
        return $this->model ? new $this->model : null;
    }

    /**
     * Get the valid data fields from the specified data array.
     * Do this by checking if the field exists in the table.
     *
     * @param array $data
     * @return array
     */
    protected function getValidData($data = [])
    {
        $validData = [];

        if (count($data)) {
            foreach ($data as $key => $value) {
                if ($this->tableHasColumn($key)) {
                    $validData[$key] = $value;
                }
            }
        }

        return $validData;
    }

    /**
     * Is the service set to load resources with their relations?
     *
     * @return bool
     */
    protected function showWithRelations()
    {
        return $this->showWithRelations;
    }

    /**
     * Get the ranking to be used when ordering resources.
     * Either ascending or descending order.
     *      *
     * @return string
     */
    protected function getRanking($ranking)
    {
        return strtolower($ranking) === 'desc' ? 'DESC' : 'ASC';
    }

    /**
     * Check if the resources should be paginated.
     *
     * @param bool|string $paginate
     * @return bool
     */
    protected function shouldPaginate($paginate = false)
    {
        return (is_string($paginate) && strtolower($paginate) === 'false') || !$paginate
                ? false : true;
    }

    /**
     * Get the per page value from the specified value.
     *
     * @param int|string $per_page
     * @return int
     */
    protected function getPerPage($per_page = 0)
    {
        $per_page = intval($per_page);

        return is_int($per_page) ? $per_page : 20;
    }

    /**
     * Check if the model has the specified column in its
     * list of columns (fields).
     *
     * @param string $field
     * @return bool
     */
    protected function tableHasColumn($column)
    {
        $table = $this->model()->getTable();

        return $column && Schema::hasColumn($table, $column);
    }

    /**
     * Add 'OR' conditions to a query to perform a search by keyword
     *
     * @param Illuminate\Database\Eloquent
     */
    public function search($query, $keyword)
    {
        $first = true;
        $model = new $this->model;

        foreach ($model->getSearchFields() as $field) {
            if ($first) {
                $query = $query->where($field, 'LIKE', '%' . $keyword . '%');
                $first = false;
            } else {
                $query = $query->orWhere($field, 'LIKE', '%' . $keyword . '%');
            }
        }

        return $query;
    }
}
