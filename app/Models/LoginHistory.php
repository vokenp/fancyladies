<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $table = "login_history";
     
    protected $fillable = [
        'created_by',
        'updated_by',
        'user_id',
        'login_date',
        'logout_date',
        'login_host',
        'login_agent',
        'login_sessionid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
