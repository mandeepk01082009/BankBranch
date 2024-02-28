<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schemes extends Model
{
    use HasFactory;
    protected $table = 'schemes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'department_id',
        'scheme_category',
        'description_of_scheme',
        'eligibility_criteria',
        'website_link',
        'active',
    ];

    public function department()
    {
         return $this->hasOne(Department::class,'id','department_id');
    }

}
