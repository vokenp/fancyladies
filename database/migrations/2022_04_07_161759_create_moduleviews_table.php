<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleviewsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "moduleviews";
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

            if (!Schema::hasColumn($tableName,'module_id')) {
                $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            }

            if (!Schema::hasColumn($tableName,'field_name')) {
                $table->string('field_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'display_name')) {
                $table->string('display_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'display_order')) {
                $table->integer('display_order')->nullable();
            }

            if (!Schema::hasColumn($tableName,'is_searchable')) {
                $table->char('is_searchable')->nullable()->default('Y');
            }

            if (!Schema::hasColumn($tableName,'list_type')) {
                $table->string('list_type')->nullable()->default('Main');
            }

    
        });
    }
}
