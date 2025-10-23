<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

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

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(MenuSubcategory::class, 'subcategory_id');
    }

    public function variants()
    {
        return $this->hasMany(MenuVariant::class, 'menu_item_id');
    }
}
