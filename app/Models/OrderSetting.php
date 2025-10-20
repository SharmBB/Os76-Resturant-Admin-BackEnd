<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSetting extends Model
{
    protected $table = 'order_settings';
    protected $fillable = [
        'order_type_dine_in_enabled',
        'order_type_takeaway_enabled',
        'order_type_delivery_enabled',
        'cod_enabled',
        'change_cod_display_name',
        'change_online_payment_display_name',
        'min_cart_value_for_delivery',
        'fssai_num',
        'gst_num',
        'pre_order_enabled',
        'show_inactive_menu_items',
        'auto_accept_orders_enabled',
    ];

    protected $casts = [
        'order_type_dine_in_enabled' => 'boolean',
        'order_type_takeaway_enabled' => 'boolean',
        'order_type_delivery_enabled' => 'boolean',
        'cod_enabled' => 'boolean',
        'min_cart_value_for_delivery' => 'integer',
        'pre_order_enabled' => 'boolean',
        'show_inactive_menu_items' => 'boolean',
        'auto_accept_orders_enabled' => 'boolean',
        
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
