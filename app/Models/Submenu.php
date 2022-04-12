<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'title',
        'page',
        'menucategory_id',
        'open_new_tab'
    ];
}
