<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsGrouplistsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "sms_grouplists";
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

            if (!Schema::hasColumn($tableName,'group_id')) {
                $table->foreignId('group_id')->nullable()->constrained('sms_groups')->cascadeOnDelete();
            }

            if (!Schema::hasColumn($tableName,'groupmember_name')) {
                $table->string('groupmember_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'groupmember_phoneno')) {
                $table->string('groupmember_phoneno')->nullable();
            }

            if (!Schema::hasColumn($tableName,'groupmember_category')) {
                $table->string('groupmember_category')->nullable();
            }

            if (!Schema::hasColumn($tableName,'groupmember_refid')) {
                $table->integer('groupmember_refid')->nullable();
            }
    
        });
    }
}
