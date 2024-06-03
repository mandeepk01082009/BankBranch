<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Department extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'department_name',
        'contact_person',  
        'email',
        'mobile',
        'is_active',
        'password',
        'user_type_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



}
