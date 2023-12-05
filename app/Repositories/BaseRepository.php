<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    //construct
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get the model instance for the repository.
     *
     * @return string
     */
    abstract public function getModel();

    /**
     * Set the model instance for the repository.
     *
     * @return void
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function getAll($columns = ['*'])
    {
        return $this->model->select($columns)->get();
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return \Illuminate\Database\Eloquent\Model|null The found model or null if not found.
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return \Illuminate\Database\Eloquent\Model The found model.
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a new record in the database with the given attributes.
     *
     * @param array $attributes The attributes to populate the new record.
     * @return \Illuminate\Database\Eloquent\Model The created model instance.
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * Create a new record in the database with the given attributes.
     *
     * @param array $attributes The attributes to populate the new record.
     * @return \Illuminate\Database\Eloquent\Model|bool The created model instance.
     */
    public function insertMultiple($attributes = [])
    {
        return $this->model->insert($attributes);
    }

    /**
     * Update a record by its primary key.
     *
     * @param int $id The primary key value.
     * @param array $attributes The data to update.
     * @return int|bool Whether the update was successful or not.
     */
    public function update($id, $attributes = [])
    {
        return $this->model->where('id', $id)->update($attributes);
    }

    /**
     * Delete a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return int|bool True if the deletion was successful, false otherwise.
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
