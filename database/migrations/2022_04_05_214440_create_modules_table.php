<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "modules";
    }

    public function up()
    {
        $tableName = $this->tblName;
        if (!Schema::hasTable($tableName)) {
            $tableName = $this->tblName;
            Schema::create($tableName, function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
            $this->addColumns();
        }
        else {
            $this->addColumns();
        }
    }

    
    public function down()
    {
        $this->addColumns();
    }

    private function addColumns()
    {
        $tableName = $this->tblName;
        Schema::table($tableName, function (Blueprint $table) {
            $tableName = $this->tblName;
            if (!Schema::hasColumn($tableName,'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn($tableName,'updated_by')) {
                $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn($tableName,'menucategory_id')) {
                $table->foreignId('menucategory_id')->nullable()->constrained('menucategories')->nullOnDelete();
            }

            if (!Schema::hasColumn($tableName,'module_code')) {
                $table->string('module_code')->nullable()->unique();
            }

            if (!Schema::hasColumn($tableName,'page_link')) {
                $table->string('page_link')->nullable();
            }

            if (!Schema::hasColumn($tableName,'module_name')) {
                $table->string('module_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'parent_table')) {
                $table->string('parent_table')->nullable();
            }

            if (!Schema::hasColumn($tableName,'model_name')) {
                $table->string('model_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'module_type')) {
                $table->string('module_type')->nullable()->default('CRUD');
            }

            if (!Schema::hasColumn($tableName,'display_order')) {
                $table->integer('display_order')->nullable()->default(1);
            }

            if (!Schema::hasColumn($tableName,'allow_delete')) {
                $table->boolean('allow_delete')->nullable()->default(false);
            }

            if (!Schema::hasColumn($tableName,'allow_view')) {
                $table->boolean('allow_view')->nullable()->default(false);
            }

            if (!Schema::hasColumn($tableName,'allow_edit')) {
                $table->boolean('allow_edit')->nullable()->default(false);
            }

            if (!Schema::hasColumn($tableName,'allow_create')) {
                $table->boolean('allow_create')->nullable()->default(false);
            }

            if (!Schema::hasColumn($tableName,'allow_export')) {
                $table->boolean('allow_export')->nullable()->default(false);
            }

            if (!Schema::hasColumn($tableName,'allow_create_modal')) {
                $table->boolean('allow_create_modal')->nullable()->default(false);
            }
    
        });
    }
}
