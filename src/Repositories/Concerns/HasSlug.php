<?php

namespace Genesis\Repositories\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    /**
     * The slug column.
     *
     * @var string
     */
    protected $slug = 'name';

    /**
     * The transaction model.
     *
     * @var Model
     */
    protected $transactionModel;

    /**
     * Find a record by slug.
     *
     * @param string $slug
     * @param array  $with
     * @param array  $select
     *
     * @return mixed
     */
    public function findBySlug(string $slug, array $with = [], $select = ['*']): mixed
    {
        return $this->model->where($this->slug, $slug)->with($with)->first($select);
    }

    /**
     * Find a record by slug.
     *
     * @param string $slug
     * @param array  $with
     * @param array  $select
     *
     * @return mixed
     */
    public function findBySlugOrFail(string $slug, array $with = [], $select = ['*']): mixed
    {
        return $this->model->where($this->slug, $slug)->with($with)->firstOrFail($select);
    }

    /**
     * Edit a record by slug.
     *
     * @param string $slug
     * @param array  $attributes
     * @param bool   $forceFill
     *
     * @return mixed
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function editBySlug(string $slug, array $attributes = [], bool $forceFill = false): mixed
    {
        $model = $this->model->where($this->slug, $slug)->firstOrFail();

        if ($forceFill) {
            if ($model->fill($attributes)->save()) {
                return $model;
            }
        } else {
            if ($model->forceFill($attributes)->save()) {
                return $model;
            }
        }

        return false;
    }

    /**
     * Delete a record by slug.
     *
     * @param string $slug
     *
     * @return int
     */
    public function deleteBySlug(string $slug)
    {
        return $this->model->where($this->slug, $slug)->delete();
    }
}
