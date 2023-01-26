<?php

namespace Genesis\Models\Relations;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelation
{
    /**
     * The user column.
     *
     * @var string
     */
    protected $userCol = 'user_id';

    /**
     * This model's relation to user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), $this->userCol);
    }
}
