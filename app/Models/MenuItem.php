<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'subcategory_id',
        'price',
        'compare_at_price',
        'type',
        'product_code',
        'description',
        'track_inventory_enabled',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'track_inventory_enabled' => 'boolean',
    ];

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function category(){
        return $this->belongsTo(MenuCategory::class);
    }

    public function subcategory(){
        return $this->belongsTo(MenuSubcategory::class);
    }

    public function variants(){
        return $this->hasMany(MenuVariant::class);
    }
}
