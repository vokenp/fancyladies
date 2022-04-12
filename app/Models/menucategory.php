<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menucategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'menu_title',
        'menu_icon',
        'menu_bullet',
        'menu_isroot',
        'menu_section'
    ];
}
