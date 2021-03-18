<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldTellerCommissionSettlements extends Model
{
    /**
     * Get the sender that owns the FieldTellerCommissionSettlements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(FieldTellers::class, 'sender_id', 'id');
    }

    /**
     * Get the sender that owns the FieldTellerCommissionSettlements
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(FieldTellers::class, 'receiver_id', 'id');
    }
}
