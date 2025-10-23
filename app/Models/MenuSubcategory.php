<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'img',
    ];

    // Subcategory belongs to a Category
    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    // Subcategory has many menu items
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'subcategory_id');
    }
}
