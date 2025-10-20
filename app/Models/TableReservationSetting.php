<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableReservationSetting extends Model
{
    protected $table = 'table_reservation_settings';
    protected $fillable = [
        'table_reservation_enabled',
        'display_menu_on_customer_web',
        'slot_duration',
        'num_of_booking',
        'max_no_guest',
        'cancellation_deadline',
        'booking_availability_period',
        'term_and_conditions',
    ];

    protected $casts = [
        'table_reservation_enabled' => 'boolean',
        'display_menu_on_customer_web' => 'boolean',
        'slot_duration' => 'integer',
        'num_of_booking' => 'integer',
        'max_no_guest' => 'integer',
        'cancellation_deadline' => 'boolean',
        'booking_availability_period' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
