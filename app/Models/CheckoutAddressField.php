<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutAddressField extends Model
{
    protected $table = 'checkout_address_fields';

    protected $fillable = [
        'flat_house_office_no_visibility',
        'address_line_visibility',
        'landmark_visibility',
        'state_visibility',
        'city_visibility',
        'pin_zip_code_visibility',
        'use_current_location_visibility',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
