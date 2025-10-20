<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'img'
    ];

    public function menuItems(){
        return $this->hasMany(MenuItem::class, 'category_id');
    }

    public function subcategories(){
        return $this->hasMany(MenuSubcategory::class, 'category_id');
    }
}
