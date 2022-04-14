<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposedSms extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'message_body',
        'send_urgency',
        'send_status',
        'distribution_list',
        'send_category',
        'message_type',
        'scheduled_date',
        'sms_bal_at'
    ];
}
