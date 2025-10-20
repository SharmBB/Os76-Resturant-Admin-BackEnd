<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableReservationDetail extends Model
{
    protected $table = 'table_reservation_details';
    protected $fillable = [
        'full_name',
        'phone_num',
        'date_to_come',
        'time_to_come',
        'num_of_guests',
        'notes',
        'customer_id',
        'outlet_id',
    ];

    protected $casts = [
        'date_to_come' => 'date',
        'time_to_come' => 'datetime:H:i:s',
        'num_of_guests' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class);
    }
}
