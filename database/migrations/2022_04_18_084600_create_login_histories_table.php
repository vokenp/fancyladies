<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoriesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "login_history";
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

            if (!Schema::hasColumn($tableName,'login_date')) {
                $table->dateTime('login_date')->nullable();
            }

            if (!Schema::hasColumn($tableName,'logout_date')) {
                $table->dateTime('logout_date')->nullable();
            }

            if (!Schema::hasColumn($tableName,'login_host')) {
                $table->string('login_host')->nullable();
            }

            if (!Schema::hasColumn($tableName,'login_agent')) {
                $table->string('login_agent')->nullable();
            }

            if (!Schema::hasColumn($tableName,'login_sessionid')) {
                $table->string('login_sessionid')->nullable();
            }
    
        });
    }
}
