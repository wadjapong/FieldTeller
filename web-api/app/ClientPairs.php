<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientPairs extends Model
{
    /**
     * The roles that belong to the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function field_teller(): BelongsToMany
    // {
    //     return $this->belongsToMany(FieldTellers::class, 'client_pairs', 'field_teller_id', 'id');
    // }

    /**
     * The roles that belong to the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    // public function merchant(): BelongsToMany
    // {
    //     return $this->belongsToMany(Merchants::class, 'client_pairs', 'merchant_id', 'role_id');
    // }

    /**
     * Get the user that owns the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field_teller(): BelongsTo
    {
        return $this->belongsTo(FieldTellers::class, 'field_teller_id', 'id');
    }

    /**
     * Get the user that owns the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchants::class, 'merchant_id', 'id');
    }

    /**
     * The field_tellers that belong to the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function field_tellers(): BelongsToMany
    {
        return $this->belongsToMany(FieldTellers::class, 'client_pairs', 'merchant_id', 'field_teller_id');
    }

    /**
     * The merchants that belong to the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function merchants(): BelongsToMany
    {
        return $this->belongsToMany(Merchants::class, 'client_pairs', 'field_teller_id', 'merchant_id');
    }

    /**
     * Get the user that owns the ClientPairs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
