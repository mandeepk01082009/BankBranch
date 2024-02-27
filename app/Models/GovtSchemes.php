<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovtSchemes extends Model
{
    use HasFactory;
    protected $table = 'govt_schemes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'sort_col',
        'name_of_ministry',
        'name_of_departments',
        'sector',
        'scheme',
        'sub_scheme',
        'objective',
        'beneficaries_type',
        'grant',
        'source_of_information',
        'status',
        'remark'
    ];
}
