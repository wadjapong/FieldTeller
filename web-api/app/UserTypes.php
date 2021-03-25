<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    // public function permission()
    // {
    //     return $this->hasManyThrough('App\UserPermissions', 'permission_id', 'id');
    // }

    /**
     * Get the role associated with the UserTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_permission_id');
    }

    /**
     * Get the user that owns the UserTypes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
