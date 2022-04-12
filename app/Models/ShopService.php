<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopService extends Model
{
    use HasFactory;
    protected $fillable =  [
        'created_by',
        'updated_by',
        'service_name',
        'service_description',
        'service_price',
        'service_commission'
    ];
}
