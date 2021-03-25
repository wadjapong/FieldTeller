<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserPermissions;

class RolePermissions extends Model
{
    /**
     * The roles that belong to the UserRoles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function permissions(): BelongsTo
    // {
    //     return $this->belongsTo(UserPermissions::class, 'role_id', 'permission_id');
    // }

    /**
     * Get the permissions that owns the RolePermissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return $this->belongsTo(UserPermissions::class, 'permission_id', 'id');
    }
}
