<?php

namespace Genesis\Repositories\Contracts;

use Illuminate\Support\Collection;

interface ActiveContract
{
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
    public function filter(bool $isActive, int $perPage = 0, array $with = [], $select = ['*'], array $sort = ['created_at' => 'desc']): Collection;

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
    public function allActive(array $with = [], $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection;

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
    public function allInactive(array $with = [], int $perPage = 0, $select = ['*'], array $sort = ['created_at' => 'desc']): Collection;
}
