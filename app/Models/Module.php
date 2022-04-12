<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_code',
        'module_name',
        'created_by',
        'updated_by',
        'menucategory_id',
        'page_link',
        'parent_table',
        'model_name',
        'module_type',
        'display_order',
        'allow_delete',
        'allow_view',
        'allow_edit',
        'allow_export',
        'allow_create_modal',
        'allow_create'
    ];

    
}
