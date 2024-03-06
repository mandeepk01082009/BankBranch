<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSRCategory extends Model
{
    use HasFactory;
    protected $table = 'csr_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'csr_category_name',
        'logo',
        'is_active',
        'status',
    ];
    
}
