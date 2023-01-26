<?php

namespace Genesis\Repositories\Concerns;

use Illuminate\Support\Collection;

trait HasCrud
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
    public function findById($id, array $with = [], $select = ['*']): mixed
    {
        return $this->model->with($with)->find($id, $select);
    }

    /**
     * Find a record by ID or Fail.
     *
     * @param mixed $id
     * @param array $with
     * @param mixed $select
     *
     * @return mixed
     */
    public function findByIdOrFail($id, array $with = [], $select = ['*']): mixed
    {
        return $this->model->with($with)->findOrFail($id, $select);
    }

    /**
     * Add a new record.
     *
     * @param array $attributes
     * @param bool  $forceFill
     *
     * @return mixed
     */
    public function add(array $attributes = [], bool $forceFill = false): mixed
    {
        $model = $this->model->newInstance();

        if ($forceFill) {
            $model->forceFill($attributes);
        } else {
            $model->fill($attributes);
        }

        if ($model->save()) {
            return $model;
        }

        return false;
    }

    /**
     * Edit a specific record.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool  $forceFill
     *
     * @return mixed
     */
    public function edit($id, array $attributes = [], bool $forceFill = false): mixed
    {
        $model = $this->model->findOrFail($id);
        if ($forceFill) {
            if ($model->forceFill($attributes)->save()) {
                return $model;
            }
        } else {
            if ($model->fill($attributes)->save()) {
                return $model;
            }
        }

        return false;
    }

    /**
     * Delete a specific record.
     *
     * @param mixed $ids
     *
     * @return int
     */
    public function delete($ids): int
    {
        return $this->model->destroy($ids);
    }

    /**
     * Delete all recrods.
     *
     * @return int
     */
    public function deleteAll(): int
    {
        return $this->model->newQuery()->delete();
    }

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
    public function all(array $with = [], int $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection
    {
        $results = $this->model->with($with);

        foreach ($sort as $column => $order) {
            $results->orderBy($column, $order);
        }

        return $perPage ? $results->paginate($perPage, $select) : $results->get($select);
    }
}
