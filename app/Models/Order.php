<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_status',
        'type',
        'payment_mode',
        'payment_status',
        'customer_id',
        'outlet_id',
    ];

    protected $casts = [
        'order_status' => 'string',
        'type' => 'string',
        'payment_mode' => 'string',
        'payment_status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
