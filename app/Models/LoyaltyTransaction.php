<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    protected $table = 'loyalty_transactions';

    protected $fillable = [
        'type',
        'points',
        'description',
        'expires_at',
        'customer_id',
    ];

    protected $casts = [
        'points' => 'integer',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // relationship
    public function customer(){
        return $this->belongsTo(Customer::class);
    }


    // Scope for filtering by type (Eloquent query scopes)
    public function scopeEarned($query){
        return $query->where('type', 'earn');
    }

    public function scopeRedeemed($query){
        return $query->where('type', 'redeem');
    }

    public function scopeExpiringSoon($query){
        return $query->where('expires_at', '<=', now()->addDays(7));
    }

}
