<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermissions extends Model
{
    /**
     * Get the user_type that owns the UserPermissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_type()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
