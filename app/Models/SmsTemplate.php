<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    use HasFactory;
    protected $table ="sms_templates";

    protected $fillable = [
        'created_by',
        'updated_by',
        'template_code',
        'template_name',
        'template_text'
    ];

}
