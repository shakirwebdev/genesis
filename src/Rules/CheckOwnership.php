<?php

namespace Genesis\Rules;

use Genesis\Models\Contracts\BypassableContract;
use Illuminate\Database\Eloquent\Model;

trait CheckOwnership
{
    /**
     * The user column.
     *
     * @var string
     */
    protected $userColumn = 'user_id';

    /**
     * Check ownershup.
     *
     * @param Model              $model
     * @param BypassableContract $user
     *
     * @return bool
     */
    public function isOwner(Model $model, BypassableContract $user)
    {
        if (!$model || !$user) {
            return false;
        }

        if ($user->bypass()) {
            return true;
        }

        return $model->{$this->userColumn} == $user->id;
    }
}
