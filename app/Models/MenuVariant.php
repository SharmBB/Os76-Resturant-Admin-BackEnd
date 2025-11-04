<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuVariant extends Model
{
    protected $fillable = [
        'menu_item_id',
        'variant_name',
        'price',
        'compare_at_price',
        'track_inventory_enabled',
        'variant_img',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'track_inventory_enabled' => 'boolean',
    ];

    public function inventories(){
        return $this->hasMany(MenuItemOutletInventory::class, 'menu_variant_id');
    }
    
    public function menuItem(){
        return $this->belongsTo(MenuItem::class);
    }
}
