<?php

namespace Genesis\Models\Scopes;

use Illuminate\Contracts\Database\Query\Builder;

trait HasCurrentScope
{
    /**
     * The active column.
     *
     * @var string
     */
    protected $currentColumn = 'is_current';

    /**
     * Local scope for getting current status.
     *
     * @param Builder $query
     * @param mixed   $current
     *
     * @return Builder
     */
    public function scopeCurrent(Builder $query, $current): Builder
    {
        return $query->where($this->currentColumn, $current);
    }
}
