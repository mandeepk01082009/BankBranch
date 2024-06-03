<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB; // This is correctly placed

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sort_col',
        'email',
        'phoneNumber',
        'bank_name',
        'dco_name',
        'is_active',
        'user_type_id',
        'bank_id',
        'block',
        'branch_address',
        'concerned_person',
        'department_name',
        'contact_person',
        'user_id',
        'otp',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function user()
    {
         return $this->hasOne(User::class,'id','bank_id');
    }

// Inside your User model or a dedicated service class
public function isBankNodal()
{
    return DB::table('bank_nodals')->where('email', $this->email)->exists();
}

public function bankNodal()
{
    // Assuming the relationship is based on the user_id column in the bank_nodals table
    return $this->hasOne(BankNodal::class, 'user_id');
}

public function messages()
{
    return $this->hasMany(Message::class);
}

}
