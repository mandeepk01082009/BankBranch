<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankNodal extends Model
{
    use HasFactory;
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
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
