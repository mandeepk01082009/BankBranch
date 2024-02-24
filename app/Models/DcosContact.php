<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DcosContact extends Model
{
    use HasFactory;
    protected $table = 'dcos_contacts';
    protected $primaryKey = 'id';
    protected $fillable = ['sort_col','email','mobile','bank_name','dco_name',];
}
