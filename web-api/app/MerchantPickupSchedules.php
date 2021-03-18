<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantPickupSchedules extends Model
{
    /**
     * Get the merchant that owns the MerchantPickupSchedules
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    /**
     * Get the merchant that owns the MerchantPickupSchedules
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
