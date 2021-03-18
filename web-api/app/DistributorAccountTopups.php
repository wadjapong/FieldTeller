<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorAccountTopups extends Model
{
    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributors::class, 'distributor_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
