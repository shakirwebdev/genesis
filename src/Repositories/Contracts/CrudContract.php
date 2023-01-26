<?php

namespace Genesis\Repositories\Contracts;

use Illuminate\Support\Collection;

interface CrudContract
{
    /**
     * Find a record by ID.
     *
     * @param mixed $id
     * @param array $with
     * @param mixed $select
     *
     * @return mixed
     */
    public function findById($id, array $with = [], $select = ['*']): mixed;

    /**
     * Find a record by ID or Fail.
     *
     * @param mixed $id
     * @param array $with
     * @param mixed $select
     *
     * @return mixed
     */
    public function findByIdOrFail($id, array $with = [], $select = ['*']): mixed;

    /**
     * Add a new record.
     *
     * @param array $attributes
     * @param bool  $forceFill
     *
     * @return mixed
     */
    public function add(array $attributes = [], bool $forceFill = false): mixed;

    /**
     * Edit a specific record.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool  $forceFill
     *
     * @return mixed
     */
    public function edit($id, array $attributes = [], bool $forceFill = false): mixed;

    /**
     * Delete a specific record.
     *
     * @param mixed $ids
     *
     * @return int
     */
    public function delete($ids): int;

    /**
     * Delete all recrods.
     *
     * @return int
     */
    public function deleteAll(): int;

    /**
     * Retrieve all records.
     *
     * @param array $with
     * @param int   $perPage
     * @param mixed $select
     * @param array $sort
     *
     * @return Collection
     */
    public function all(array $with = [], int $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection;
}
