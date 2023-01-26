<?php

namespace Genesis\Models\Contracts;

interface Stateable
{
    /**
     * Get the state id.
     *
     * @return mixed
     */
    public function getEntityId(): mixed;

    /**
     * Get the foreign key.
     *
     * @return string
     */
    public function getForeignKey(): string;
}
