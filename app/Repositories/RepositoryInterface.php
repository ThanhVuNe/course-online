<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @param array $columns
     * @return mixed
     */
    public function getAll($columns = ['*']);

    /**
     * Find a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return \Illuminate\Database\Eloquent\Model|null The found model or null if not found.
     */
    public function find($id);

    /**
     * Find a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return \Illuminate\Database\Eloquent\Model The found model.
     */
    public function findOrFail($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Create many
     * @param array $attributes
     * @return mixed
     */
    public function insertMultiple($attributes = []);

    /**
     * Update a record by its primary key.
     *
     * @param int $id The primary key value.
     * @param array $attributes The data to update.
     * @return bool Whether the update was successful or not.
     */
    public function update($id, $attributes = []);

    /**
     * Delete a record by its primary key.
     *
     * @param int $id The primary key value.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function delete($id);
}
