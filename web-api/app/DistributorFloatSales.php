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
    public function distributor()
    {
        return $this->belongsTo(Distributors::class, 'distributor_id', 'id');
    }

    /**
     * Get the field_teller that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field_teller()
    {
        return $this->belongsTo(FieldTellers::class, 'field_teller_id', 'id');
    }

    /**
     * Get the distributor that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * Get the field_teller that owns the DistributorFloatSales
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
