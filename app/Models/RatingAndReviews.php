<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RatingAndReviews extends Model
{
    protected $table = 'ratings_and_reviews';
    protected $fillable = [
        'star_rating',
        'review',
        'date_time',
        'outlet_id',
        'customer_id',
    ];

    protected $casts = [
        'star_rating' => 'integer',
        'date_time' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
