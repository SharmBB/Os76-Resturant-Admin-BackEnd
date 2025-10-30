<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $fillable = [
        'item_name',
        'qty',
        'price',
        'total_price',
        'order_id',
    ];

    protected $casts = [
        'qty' => 'integer',
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // order relation
    public function order(){
        return $this->belongsTo(Order::class);
    }

}
