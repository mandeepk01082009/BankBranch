<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementRate extends Model
{
    use HasFactory;
    protected $table = 'advertisement_rates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'advertisement_slot',
        'minimum_days',
        'per_day_rate',
        'size',
        'status'
    ];

}
