<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    /**
     * The roles that belong to the UserRoles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permissions::class, 'user_permissions', 'role_id', 'permission_id');
    }
}
