<?php

namespace Genesis\Repositories\Contracts;

interface SlugContract
{
    /**
     * Find a record by slug.
     *
     * @param string $slug
     * @param array  $with
     * @param array  $select
     *
     * @return mixed
     */
    public function findBySlug(string $slug, array $with = [], $select = ['*']): mixed;

    /**
     * Find a record by slug.
     *
     * @param string $slug
     * @param array  $with
     * @param array  $select
     *
     * @return mixed
     */
    public function findBySlugOrFail(string $slug, array $with = [], $select = ['*']): mixed;

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
    public function editBySlug(string $slug, array $attributes = [], bool $forceFill = false): mixed;

    /**
     * Delete a record by slug.
     *
     * @param string $slug
     *
     * @return int
     */
    public function deleteBySlug(string $slug);
}
