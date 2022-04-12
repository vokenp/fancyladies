<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class moduleview extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'updated_by',
        'module_id',
        'field_name',
        'display_name',
        'display_order',
        'is_searchable',
        'list_type'
    ];
}
