<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTokenSetting extends Model
{
    protected $table = 'order_token_settings';
    protected $fillable = [
        'token_prefix',
        'token_num_start',
        'token_num_end',
        'token_suffix',
        'token_daily_reset_enabled',
    ];

    protected $casts = [
        'token_num_start' => 'integer',
        'token_num_end' => 'integer',
        'token_daily_reset_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
