<?php

namespace Genesis\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SoftDeleteableContract
{
    /**
     * Retrieve all trashed.
     *
     * @param array $related
     * @param int   $perPage
     * @param mixed $select
     *
     * @return Collection
     */
    public function trashed($related = [], int $perPage = 0, $select = ['*']): Collection;

    /**
     * Retrieve a single record by id.
     *
     * @param mixed $id
     * @param array $related
     * @param array $select
     *
     * @return mixed
     */
    public function findTrashed($id, array $related = [], $select = ['*']): mixed;

    /**
     * Restore a record.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function restore($id): mixed;
}
