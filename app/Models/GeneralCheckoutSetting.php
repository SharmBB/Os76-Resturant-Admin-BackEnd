<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralCheckoutSetting extends Model
{
    protected $table = 'general_checkout_settings';

    protected $fillable = [
        'checkout_notes',
        'round_off_order_amount_enabled',
        'tip_feature_enabled',
        'guest_checkout_customer_web_enabled',
    ];

    protected $casts = [
        'round_off_order_amount_enabled' => 'boolean',
        'tip_feature_enabled' => 'boolean',
        'guest_checkout_customer_web_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
