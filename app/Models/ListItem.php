<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    use HasFactory;
    protected $table = "listitems";
    
    protected $fillable = [
        'item_type',
        'item_code',
        'item_description',
        'created_by',
        'updated_by'
    ];
}
