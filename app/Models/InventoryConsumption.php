<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryConsumption extends Model
{
     protected $fillable = [
        'consumed_quantity',
        'remark',
        'menu_item_outlet_inventory_id',
        'outlet_id',
    ];

    public function inventory(){
        return $this->belongsTo(MenuItemOutletInventory::class, 'menu_item_outlet_inventory_id');
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }
}
