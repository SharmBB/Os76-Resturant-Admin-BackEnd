<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuManagementList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function menuItems(){
        return $this->belongsToMany(MenuItem::class, 'menu_list_menu_items');
    }

    public function outlets(){
        return $this->belongsToMany(Outlet::class, 'menu_list_outlets');
    }

}
