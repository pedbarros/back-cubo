<?php

namespace App\Repositories;

use App\Models\Information;

class InformationRepository implements InterfaceRepository
{
    /**
     * @var App\Models\Information
     */
    private $model;

    /**
     * InformationRepository constructor.
     * @param Information $model
     */
    public function __construct(Information $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $model = $this->getById($id);
        $model->update($attributes);
        return $model;
    }

    public function delete($id)
    {
        $this->getById($id)->delete();
        return true;
    }
}
