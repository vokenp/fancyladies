<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposedSmsTable extends Migration
{
    
    public $tblName;

    public function __construct()
    {
        $this->tblName = "composed_sms";
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

            if (!Schema::hasColumn($tableName,'message_body')) {
                $table->text('message_body')->nullable();
            }

            if (!Schema::hasColumn($tableName,'send_urgency')) {
                $table->string('send_urgency')->nullable();
            }

            if (!Schema::hasColumn($tableName,'send_status')) {
                $table->string('send_status')->nullable()->default('Pending');
            }

            if (!Schema::hasColumn($tableName,'distribution_list')) {
                $table->text('distribution_list')->nullable();
            }

            if (!Schema::hasColumn($tableName,'message_type')) {
                $table->string('message_type')->nullable();
            }

            if (!Schema::hasColumn($tableName,'send_category')) {
                $table->string('send_category')->nullable();
            }

            if (!Schema::hasColumn($tableName,'scheduled_date')) {
                $table->dateTime('scheduled_date')->nullable();
            }

            if (!Schema::hasColumn($tableName,'sms_bal_at')) {
                $table->integer('sms_bal_at')->nullable();
            }

            
    
        });
    }
}
