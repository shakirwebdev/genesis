<?php

namespace Genesis\Repositories\Concerns;

use Illuminate\Support\Collection;

trait HasActive
{
    /**
     * The column for active flag.
     *
     * @var string
     */
    protected $activeColumn = 'is_active';

    /**
     * Retrieve records by filtering the active column.
     *
     * @param bool  $isActive
     * @param int   $perPage
     * @param array $with
     * @param mixed $select
     * @param array $sort
     *
     * @return Collection
     */
    public function filter(bool $isActive, int $perPage = 0, array $with = [], $select = ['*'], array $sort = ['created_at' => 'desc']): Collection
    {
        $results = $this->model->with($with);

        foreach ($sort as $column => $order) {
            $results->orderBy($column, $order);
        }

        $results->where($this->activeColumn, $isActive);

        return $perPage ? $results->paginate($perPage, $select) : $results->get($select);
    }

    /**
     * Retrieve all active records.
     *
     * @param array $with
     * @param int   $perPage
     * @param mixed $select
     * @param array $sort
     *
     * @return Collection
     */
    public function allActive(array $with = [], $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection
    {
        $results = $this->model->with($with);

        foreach ($sort as $column => $order) {
            $results->orderBy($column, $order);
        }

        $results->where($this->activeColumn, 1);

        return $perPage ? $results->paginate($perPage, $select) : $results->get($select);
    }

    /**
     * Retrieve all inactive records.
     *
     * @param array $with
     * @param int   $perPage
     * @param mixed $select
     * @param array $sort
     *
     * @return Collection
     */
    public function allInactive(array $with = [], int $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection
    {
        $results = $this->model->with($with);

        foreach ($sort as $column => $order) {
            $results->orderBy($column, $order);
        }

        $results->where($this->activeColumn, 0);

        return $perPage ? $results->paginate($perPage, $select) : $results->get($select);
    }
}
