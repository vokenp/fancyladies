<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "customers";
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

            if (!Schema::hasColumn($tableName,'customer_name')) {
                $table->string('customer_name')->nullable();
            }


            if (!Schema::hasColumn($tableName,'customer_phoneno')) {
                $table->string('customer_phoneno')->nullable();
            }

            if (!Schema::hasColumn($tableName,'customer_email')) {
                $table->string('customer_email')->nullable();
            }

            if (!Schema::hasColumn($tableName,'customer_code')) {
                $table->string('customer_code')->nullable()->index();
            }
    
        });
    }
}
