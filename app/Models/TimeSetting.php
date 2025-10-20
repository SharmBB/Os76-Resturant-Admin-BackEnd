<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSetting extends Model
{
    protected $table = 'time_settings';
    protected $fillable = [
        'open_24_hours_enabled',
        'closed_status',
        'open_time',
        'close_time',
        'time_slots_id',
        'outlet_id',
    ];

    protected $casts = [
        'open_24_hours_enabled' => 'boolean',
        'closed_status' => 'boolean',

        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    // for get dates
    public function timeSlot(){
        return $this->belongsTo(TimeSlot::class, 'time_slots_id');
    }

}
