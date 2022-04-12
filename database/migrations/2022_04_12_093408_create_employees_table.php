<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "employees";
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

            if (!Schema::hasColumn($tableName,'employee_name')) {
                $table->string('employee_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'employee_idno')) {
                $table->string('employee_idno')->nullable()->unique();
            }

            if (!Schema::hasColumn($tableName,'employee_phoneno')) {
                $table->string('employee_phoneno')->nullable();
            }

            if (!Schema::hasColumn($tableName,'employee_email')) {
                $table->string('employee_email')->nullable();
            }
    
        });
    }
}
