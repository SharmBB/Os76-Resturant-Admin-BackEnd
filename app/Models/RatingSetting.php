<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingSetting extends Model
{
    protected $table = 'rating_settings';
    protected $fillable = [
        'customers_rate_store_enabled',
        'show_store_ratings_enabled',
        'customers_rate_products_enabled',
        'show_products_ratings_enabled',
    ];

    protected $casts = [
        'customers_rate_store_enabled' => 'boolean',
        'show_store_ratings_enabled' => 'boolean',
        'customers_rate_products_enabled' => 'boolean',
        'show_products_ratings_enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

}
