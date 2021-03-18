<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributorFloatSales extends Model
{
    /**
     * Get the distributor that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributors::class, 'distributor_id', 'id');
    }

    /**
     * Get the field_teller that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field_teller(): BelongsTo
    {
        return $this->belongsTo(FieldTellers::class, 'field_teller_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Get the field_teller that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
