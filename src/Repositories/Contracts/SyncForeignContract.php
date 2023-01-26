<?php

namespace Genesis\Repositories\Contracts;

interface SyncForeignContract
{
    /**
     * Sync main table data to foreign table.
     *
     * @param int $id
     * @param  array attachIds
     *
     * @return int
     */
    public function sync(int $id, array $attributes): int;

    /**
     * Append main table data to foreign table.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return int
     */
    public function append(int $id, array $attributes): int;
}
