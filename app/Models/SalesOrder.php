<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = "sales_order";

    protected $fillable = [
        'created_by',
        'updated_by',
        'sales_date',
        'customer_id',
        'sales_total'
    ];
}
