<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BongaSmsout extends Model
{
    use HasFactory;
    protected $table = "bonga_smsouts";

    protected $fillable = [
        'created_by',
        'updated_by',
        'send_status',
        'short_code',
        'phone',
        'message',
        'correlator',
        'uniqueId',
        'sms_units',
        'response_message',
        'batch_id',
        'unit_price',
        'total_price',
        'link_id',
        'formatted_status',
        'deliveryStatus',
        'deliveryTime',
        'receiver_category',
        'receiver_id',
        'composed_sms_id'
    ];
}
