<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicNotices extends Model
{
    use HasFactory;
    protected $table = 'public_notices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'title',
        'notice',
        'status',
    ];
}
