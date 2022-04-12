<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "expenses";
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

            if (!Schema::hasColumn($tableName,'expense_name')) {
                $table->string('expense_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'expense_amount')) {
                $table->decimal('expense_amount')->nullable();
            }

            if (!Schema::hasColumn($tableName,'expense_mop')) {
                $table->string('expense_mop')->nullable();
            }

            if (!Schema::hasColumn($tableName,'expense_date')) {
                $table->date('expense_date')->nullable();
            }

            if (!Schema::hasColumn($tableName,'expense_remarks')) {
                $table->string('expense_remarks')->nullable();
            }
    
        });
    }
}
