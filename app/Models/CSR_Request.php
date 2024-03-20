<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSR_Request extends Model
{
    use HasFactory;
    protected $table = 'csr_requests';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'department_id',
        'csr_category_id',
        'details',
        'estimated_expense',
        'is_active',
    ];

    public function user()
    {
         return $this->hasOne(User::class,'id','department_id');
    }

    public function csrCategory()
    {
         return $this->hasOne(CSRCategory::class,'id','csr_category_id');
    }

}
