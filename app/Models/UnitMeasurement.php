<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitMeasurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'measurement_name',
    ];
}
