<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'code',
        'description',
        'type',
        'discount_amount',
        'usage_time',
        'activation_date',
        'expiry_date',
        'coupon_img',
    ];


    protected $casts = [
        'code' => 'string',
        'description' => 'string',
        'type' => 'string',
        'discount_amount' => 'decimal:2',
        'activation_date' => 'date',
        'expiry_date' => 'date',
        'coupon_img' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // define relation with coupon_customers table (pivot table)
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_customers')
            ->withPivot('used_at')
            ->withTimestamps();
    }
}
