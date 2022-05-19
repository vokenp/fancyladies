<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'updated_by',
        'customer_name',
        'customer_phoneno',
        'customer_email',
        'customer_code'
    ];
}
