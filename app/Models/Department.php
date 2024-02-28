<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'department_name',
        'contact_person',
        'email',
        'contact',
        'status',
    ];

}
