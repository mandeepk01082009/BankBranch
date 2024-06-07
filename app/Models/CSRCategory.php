<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSRCategory extends Model
{
    use HasFactory;
    protected $table = 'csr_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'csr_category_name',
        'logo',
        'bg_color',
        'is_active',
        'status',
    ];

    public function csrRequests()
{
    return $this->hasMany(CSR_Request::class, 'csr_category_id', 'id');
}
    
}
