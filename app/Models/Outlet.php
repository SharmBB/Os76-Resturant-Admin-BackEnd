<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = 'outlets';
    protected $fillable = [
        'outlet_name',
        'address_line_1',
        'address_line_2',
        'city',
        'pin_zip_code',
        'latitude',
        'longitude',
        'qr_code',
        'status',
        'outlet_web_url',
    ];

    protected $casts = [
        'outlet_name' => 'string',
        'address_line_1' => 'string',
        'address_line_2' => 'string',
        'city' => 'string',
        'pin_zip_code' => 'string',

        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',

        'qr_code' => 'string',
        'status' => 'boolean',

        'outlet_web_url' => 'string',

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    public function menuLists(){
        return $this->belongsToMany(MenuManagementList::class, 'menu_list_outlet');
    }

    public function timeSettings(){
        return $this->hasMany(TimeSetting::class);
    }

    public function reviews(){
        return $this->hasMany(RatingAndReviews::class);
    }

    public function SupportSetting(){
        return $this->hasOne(SupportSetting::class);
    }

    public function menuItems(){
        return $this->hasMany(MenuItem::class);
    }

    // reseration relation
    public function TableReservationDetail(){
        return $this->hasMany(TableReservationDetail::class);
    }

    // order relation
    public function Order(){
        return $this->hasMany(Order::class);
    }

}
