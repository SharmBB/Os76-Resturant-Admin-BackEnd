<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltySetting extends Model
{
    protected $table = 'loyalty_settings';

    protected $fillable = [
        'is_active',
        'custom_status',
        'credit_expiry_days',
        'signup_points_enabled',
        'spend_points_enabled',
        'order_amount_points_enabled',
        'order_type_points_enabled',

        'currency_value',
        'redeem_points_enabled',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'custom_status' => 'boolean',
        'signup_points_enabled' => 'boolean',
        'spend_points_enabled' => 'boolean',
        'order_amount_points_enabled' => 'boolean',
        'order_type_points_enabled' => 'boolean',
        'redeem_points_enabled' => 'boolean',

        'currency_value' => 'decimal:2',
        'credit_expiry_days' => 'integer',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
