<?php

namespace Genesis\Models\Collections;

use Illuminate\Database\Eloquent\Collection;

class DropDownCollection extends Collection
{
    /**
     * Convert collection to dropdown.
     *
     * @param string $nameField
     * @param string $idField
     * @param string $defaultNullText
     *
     * @return array
     */
    public function dropDown(string $nameField, string $idField = 'id', string $defaultNullText = '--'): array
    {
        $listFieldValues = $this->pluck($nameField, $idField)->toArray();

        $selectArray = [];
        if ($defaultNullText) {
            $selectArray[''] = $defaultNullText;
        }

        return $selectArray + $listFieldValues;
    }
}
