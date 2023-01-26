<?php

namespace Genesis\Models\Relations;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HistoryRelation
{
    /**
     * Get the state id.
     *
     * @return mixed
     */
    public function getEntityId(): mixed
    {
        return $this->{$this->getEntityKey()};
    }

    /**
     * Get the state id.
     *
     * @return string
     */
    public function getEntityKey(): string
    {
        return 'id';
    }

    /**
     * This model's relation to support ticket status histories.
     *
     * @return HasMany
     */
    public function histories(): HasMany
    {
        return $this->hasMany($this->getHistoryModel(), $this->getForeignKey());
    }

    /**
     * Getting model's current status.
     *
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasOne($this->getHistoryModel(), $this->getForeignKey())->current(1);
    }

    /**
     * Get the history model.
     *
     * @return string
     */
    abstract public function getHistoryModel();
}
