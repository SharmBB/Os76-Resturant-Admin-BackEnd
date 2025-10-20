<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosAddressFieldSetting extends Model
{
    protected $table = 'pos_address_field_settings';
    protected $fillable = [
        'takeaway_enabled',
        'delivery_enabled',
        'dine_in_enabled',
        'mobile_visibility',
        'name_visibility',
        'email_visibility',
        'instruction_visibility',
    ];

    protected $casts = [
        'takeaway_enabled' => 'boolean',
        'delivery_enabled' => 'boolean',
        'dine_in_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
