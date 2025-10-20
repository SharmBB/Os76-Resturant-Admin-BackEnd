<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomCheckoutForm extends Model
{
    protected $table = 'custom_checkout_forms';

    protected $fillable = [
        'field_name',
        'field_type',
        'takeaway_enabled',
        'delivery_enabled',
        'dine_in_enabled',
        'table_room_enabled',
        'take_order_enabled',
        'is_hide_enabled',
        'is_required_enabled',
    ];

    protected $casts = [
        'takeaway_enabled' => 'boolean',
        'delivery_enabled' => 'boolean',
        'dine_in_enabled' => 'boolean',
        'table_room_enabled' => 'boolean',
        'take_order_enabled' => 'boolean',
        'is_hide_enabled' => 'boolean',
        'is_required_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
