<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankBranches extends Model
{
    use HasFactory;
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
    ];

    public function bankName()
    {
         return $this->hasOne(BankNodal::class,'id','bank_id');
    }
}
