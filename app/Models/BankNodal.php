<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class BankNodal extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'bank_nodals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'email',
        'mobile',
        'bank_name',
        'dco_name',
        'password',
        'is_active',
        'user_type_id',
        'apply_loan_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
