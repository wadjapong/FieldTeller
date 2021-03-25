<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distributors extends Model
{
    
    /**
     * Get the user that owns the Distributors
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creater()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
