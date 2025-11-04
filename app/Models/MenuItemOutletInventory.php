<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemOutletInventory extends Model
{

    protected $fillable = [
        'product_name',
        'sku',
        'available_quantity',
        'allow_out_of_stock_sales',
        'menu_item_id',
        'outlet_id',
        'menu_variant_id',
    ];

    public function consumptions(){
        return $this->hasMany(InventoryConsumption::class);
    }

    public function variant(){
        return $this->belongsTo(MenuVariant::class, 'menu_variant_id');
    }

    public function menuItem(){
        return $this->belongsTo(MenuItem::class);
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }
}
