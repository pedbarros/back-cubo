<?php

namespace App\Repositories;

use App\User;

class UserRepository implements InterfaceRepository
{
    /**
     * @var App\Models\User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
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

    public function getSumParticipation()
    {
        return $this->model->all()->sum('participation');
    }

    public function permissionToAddInformation($addParticipation)
    {
        return (  ( $this->getSumParticipation() + $addParticipation ) > 100  );
    }



}
