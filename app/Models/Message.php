<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

protected $fillable = ['user_id', 'text', 'file', 'applicant_id', 'status', 'user_type_id'];

public function user()
{
    return $this->belongsTo(User::class);
}

public function bankBranch()
{
    return $this->belongsTo(BankBranches::class, 'user_id');
}

public function applyLoan()
{
    return $this->belongsTo(ApplyLoans::class);
}

public function userType()
{
    return $this->belongsTo(UserType::class);
}

}
