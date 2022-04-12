<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'updated_by',
        'employee_idno',
        'employee_name',
        'employee_phoneno',
        'employee_email'
    ];
}
