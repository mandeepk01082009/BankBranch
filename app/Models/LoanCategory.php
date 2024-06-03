<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCategory extends Model
{
    use HasFactory;
    protected $table = 'loan_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'sort_col',
        'is_active',
    ];
}
