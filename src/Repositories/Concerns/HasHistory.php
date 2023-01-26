<?php

namespace Genesis\Repositories\Concerns;

use Genesis\Models\Contracts\Stateable;
use Illuminate\Database\Eloquent\Model;

trait HasHistory
{
    /**
     * The history model.
     *
     * @var Model
     */
    protected $historyModel;

    /**
     * The current column.
     *
     * @var string
     */
    protected $currentColumn = 'is_current';

    /**
     * Move state of a certain entity.
     *
     * @param Stateable $moveable
     * @param Stateable $state
     * @param array     $attributes
     *
     * @return bool
     */
    public function changeState(Stateable $moveable, Stateable $state, array $attributes = []): bool
    {
        // Reset all current
        $this->historyModel
                ->where($moveable->getForeignKey(), $moveable->getEntityId())
                ->update([$this->currentColumn => 0]);

        $attributes = array_merge($attributes, [
                    $moveable->getForeignKey() => $moveable->getEntityId(),
                    $state->getForeignKey() => $state->getEntityId(),
                    $this->currentColumn => 1,
        ]);

        return $this->historyModel
                    ->newInstance($attributes)
                    ->save();
    }
}
