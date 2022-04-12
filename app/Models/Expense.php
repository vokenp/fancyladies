<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'expense_name',
        'expense_amount',
        'expense_mop',
        'expense_date',
        'expense_remarks'
    ];
}
