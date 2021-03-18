<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorFloatTransfers extends Model
{
    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Distributors::class, 'sender_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Distributors::class, 'receiver_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
