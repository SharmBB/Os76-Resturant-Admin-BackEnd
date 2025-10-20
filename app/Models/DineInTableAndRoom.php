<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DineInTableAndRoom extends Model
{
    protected $table = 'dine_in_tables_and_rooms';

    protected $fillable = [
        'table_num',
        'room_num',
        'table_name',
        'room_name',
        'table_qr_code',
        'room_qr_code',
        'num_of_tables',
        'num_of_rooms',
    ];

    protected $casts = [
        'num_of_tables' => 'integer',
        'num_of_rooms' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
