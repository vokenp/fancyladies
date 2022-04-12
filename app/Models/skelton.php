<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skelton extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'created_by',
        'update_by',
        'def_colomn'
    ];
}
