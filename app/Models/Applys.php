<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notifiable;

class Applys extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'applys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'phoneNumber',
        'bank_name',
        'status',
        'password',
        'is_active',
        'user_type_id',
        'applicant_id',
        'state',
        'city',
        'pincode',
        'address',
        'landmark',
        'loanDescription',
        'loan_category',
        'bankName',
        'bankBranch',
        'otp',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function messages()
    {
     return $this->hasMany(Message::class, 'applicant_id');
    }
 
     public function loanCategory()
     {
         return $this->belongsTo(LoanCategory::class, 'loan_category');
     }

     public function bankNodal()
     {
         return $this->belongsTo(BankNodal::class, 'bankName', 'id');
     }
 
     public function bankBranches()
     {
         return $this->belongsTo(BankBranches::class, 'bankBranch', 'id');
     }
 
     public function user()
 {
     return $this->belongsTo(User::class);
 }
}
