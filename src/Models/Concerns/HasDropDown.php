<?php

namespace Genesis\Models\Concerns;

use Genesis\Models\Collections\DropDownCollection;

trait HasDropDown
{
    /**
     * Create new collection.
     *
     * @return DropDownCollection
     */
    public function newCollection(array $models = []): DropDownCollection
    {
        return new DropDownCollection($models);
    }
}
