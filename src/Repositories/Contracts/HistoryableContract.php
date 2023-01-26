<?php

namespace Genesis\Repositories\Contracts;

use Genesis\Models\Contracts\Stateable;

interface HistoryableContract
{
    /**
     * Move state of a certain entity.
     *
     * @param Stateable $moveable
     * @param Stateable $state
     * @param array     $attributes
     *
     * @return bool
     */
    public function changeState(Stateable $moveable, Stateable $state, array $attributes = []): bool;
}
