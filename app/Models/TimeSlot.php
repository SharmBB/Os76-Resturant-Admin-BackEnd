<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $table = 'time_slots';
    protected $fillable = [
        'day',
        'message_when_store_offline'
    ];

    protected $casts = [
        'day' => 'string',
        'message_when_store_offline' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function timeSettings(){
        return $this->hasMany(TimeSetting::class, 'time_slots_id');
    }

}
