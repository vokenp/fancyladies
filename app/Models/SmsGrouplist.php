<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsGrouplist extends Model
{
    use HasFactory;
    protected $table = "sms_grouplists";

    protected $fillable = [
        'created_by',
        'updated_by',
        'group_id',
        'groupmember_name',
        'groupmember_phoneno',
        'groupmember_category',
        'groupmember_refid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function smsgroup()
    {
        return $this->belongsTo(SmsGroup::class,'group_id');
    }
}
