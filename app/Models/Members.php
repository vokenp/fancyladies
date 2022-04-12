<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'member_no',
        'member_name',
        'member_dob',
        'member_idno',
        'member_gender',
        'member_martialstatus',
        'member_phoneno',
        'member_email',
        'member_type',
        'member_occupation',
        'member_residence'
    ];
}
