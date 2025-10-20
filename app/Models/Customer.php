<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'status'
    ];

    protected $casts = [
        'name' => 'string',
        'mobile' => 'string',
        'email' => 'string',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // (coupon_customers pivot table)
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'coupon_customers')
            ->withPivot('used_at')
            ->withTimestamps();
    }

    // Loyalty relations
    public function loyalty(){
        return $this->hasOne(CustomerLoyalty::class);
    }

    public function loyaltyTransactions(){
        return $this->hasMany(LoyaltyTransaction::class);
    }

    // reseration relation
    public function TableReservationDetail(){
        return $this->hasMany(TableReservationDetail::class);
    }

    // order relation
    public function Order(){
        return $this->hasMany(Order::class);
    }

    // raing and reviews relation
    public function reviews(){
        return $this->hasMany(RatingAndReviews::class);
    }
}
