<?php

namespace Genesis\Repositories\Concerns;

use Illuminate\Support\Collection;

trait HasSoftDelete
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
    public function trashed($related = [], int $perPage = 0, $select = ['*']): Collection
    {
        $trashed = $this->model->onlyTrashed()->with($related);

        return $perPage ? $trashed->paginate($perPage, $select) : $trashed->get($select);
    }

    /**
     * Retrieve a single record by id.
     *
     * @param mixed $id
     * @param array $related
     * @param array $select
     *
     * @return mixed
     */
    public function findTrashed($id, array $related = [], $select = ['*']): mixed
    {
        return $this->model->onlyTrashed()->with($related)->find($id);
    }

    /**
     * Restore a record.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function restore($id): mixed
    {
        $model = $this->findTrashed($id);
        if ($model) {
            $model->restore();
        }

        return $model;
    }
}
