<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MerchantSettlements extends Model
{
    
    /**
     * Get the user that owns the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }
    
    /**
     * Get the user that owns the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
