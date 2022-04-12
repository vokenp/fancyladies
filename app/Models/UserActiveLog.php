<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActiveLog extends Model
{
    use HasFactory;
    protected $table = "user_active_logs";

    protected $fillable = [
        'created_by',
        'updated_by',
        'user_id',
        'active_status',
        'active_reason'
    ];
}
