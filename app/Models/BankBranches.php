<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BankBranches extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'bank_branches';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'email',
        'mobile',
        'bank_id',
        'block',
        'branch_address',
        'concerned_person',
        'is_active',
        'password',
        'user_type_id',
        'apply_loan_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bankName()
    {
         return $this->belongsTo(BankNodal::class, 'bank_id');
    }
}
