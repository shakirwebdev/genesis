<?php

namespace Genesis\Models\Contracts;

interface BypassableContract
{
    /**
     * Can by bypass for ownership rules.
     *
     * @return bool
     */
    public function bypass(): bool;
}
