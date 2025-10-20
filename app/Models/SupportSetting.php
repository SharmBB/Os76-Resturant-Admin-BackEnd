<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSetting extends Model
{
    protected $table = 'support_settings';

    protected $fillable = [
        'customer_care_number',
        'whatsapp_number',
        'customer_care_email',
        'outlet_id',
    ];

    protected $casts = [
        'customer_care_number' => 'string',
        'whatsapp_number' => 'string',
        'customer_care_email' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }
    
}
