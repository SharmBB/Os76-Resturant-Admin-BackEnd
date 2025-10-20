<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerLoyalty extends Model
{
    protected $table = 'customer_loyalty';

    protected $fillable = [
        'customer_id',
        'points_balance',
        'total_spent',
    ];

    protected $casts = [
        'points_balance' => 'integer',
        'total_spent' => 'decimal:2',
        
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
