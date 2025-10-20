<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderIdSetting extends Model
{
    protected $table = 'order_id_settings';

    protected $fillable = [
        'id_prefix',
        'id_sufix',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
