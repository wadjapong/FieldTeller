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
    public function sender()
    {
        return $this->belongsTo(Distributors::class, 'sender_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver()
    {
        return $this->belongsTo(Distributors::class, 'receiver_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorAccountTopups
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
