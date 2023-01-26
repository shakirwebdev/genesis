<?php

namespace Genesis\Models\Scopes;

use Illuminate\Contracts\Database\Query\Builder;

trait HasActiveScope
{
    /**
     * The active column.
     *
     * @var string
     */
    protected $activeCol = 'is_active';

    /**
     * Local scope for active.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where($this->getTable().'.'.$this->activeCol, 1);
    }

    /**
     * Local scope for inactive.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where($this->getTable().'.'.$this->activeCol, 0);
    }
}
