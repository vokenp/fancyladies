<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsGroup extends Model
{
    use HasFactory;
    protected $table = "sms_groups";

    protected $fillable = [
     'created_by',
     'updated_by',
     'group_name',
     'group_description'
    ];
}
