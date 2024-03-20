<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsefulLinks extends Model
{
    use HasFactory;
    protected $table = 'useful_links';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'link',
        'logo',
        'useful_link',
        'status',
    ];
}
