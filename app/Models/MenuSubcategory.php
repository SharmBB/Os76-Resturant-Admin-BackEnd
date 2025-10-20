<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSubcategory extends Model
{
    protected $fillable = [
        'category_id', 
        'name', 
        'description', 
        'img'
    ];

    public function category(){
        return $this->belongsTo(MenuCategory::class);
    }

    public function menuItems(){
        return $this->hasMany(MenuItem::class, 'subcategory_id');
    }
}
