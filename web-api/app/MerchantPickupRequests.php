<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantPickupRequests extends Model
{
    /**
     * Get the merchant that owns the MerchantPickupRequests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchants::class, 'merchants_id', 'id');
    }

    /**
     * Get the field_teller that owns the MerchantPickupRequests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field_teller(): BelongsTo
    {
        return $this->belongsTo(FieldTellers::class, 'field_teller_id', 'id');
    }

    /**
     * Get the user that owns the MerchantPickupRequests
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
