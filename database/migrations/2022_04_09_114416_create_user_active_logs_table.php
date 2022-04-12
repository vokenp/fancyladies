<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActiveLogsTable extends Migration
{
    
    public $tblName;

    public function __construct()
    {
        $this->tblName = "user_active_logs";
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

            if (!Schema::hasColumn($tableName,'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users');
            }

            if (!Schema::hasColumn($tableName,'active_status')) {
                $table->string('active_status')->nullable()->default('Active');
            }

            if (!Schema::hasColumn($tableName,'active_reason')) {
                $table->string('active_reason')->nullable()->default('Creation');
            }
    
        });
    }
}
