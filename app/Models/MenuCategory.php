<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'img',
    ];

    // One category can have many subcategories
    public function subcategories()
    {
        return $this->hasMany(MenuSubcategory::class, 'category_id');
    }

    // One category can have many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }
}
