<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    /**
     * Get all of the permissions for the Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permissions::class, 'permission_id', 'id');
    }
}
