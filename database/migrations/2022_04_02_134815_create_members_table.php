<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "members";
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

            if (!Schema::hasColumn($tableName,'member_no')) {
                $table->string('member_no')->unique();
            }

            if (!Schema::hasColumn($tableName,'member_name')) {
                $table->string('member_name')->nullable();
            }
            if (!Schema::hasColumn($tableName,'member_dob')) {
                $table->date('member_dob')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_idno')) {
                $table->string('member_idno')->nullable()->unique();
            }

            if (!Schema::hasColumn($tableName,'member_gender')) {
                $table->string('member_gender')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_martialstatus')) {
                $table->string('member_martialstatus')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_phoneno')) {
                $table->string('member_phoneno')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_email')) {
                $table->string('member_email')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_occupation')) {
                $table->string('member_occupation')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_residence')) {
                $table->string('member_residence')->nullable();
            }

            if (!Schema::hasColumn($tableName,'member_type')) {
                $table->string('member_type')->nullable()->default('Interim');
            }
    
        });
    }
}
