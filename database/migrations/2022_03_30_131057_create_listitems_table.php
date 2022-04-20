<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListitemsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "listitems";
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

            if (!Schema::hasColumn($tableName,'item_type')) {
                $table->string('item_type')->nullable()->index();
            }

            if (!Schema::hasColumn($tableName,'item_code')) {
                $table->string('item_code')->nullable()->index();
            }


            if (!Schema::hasColumn($tableName,'item_description')) {
                $table->string('item_description')->nullable();
            }
    
        });
    }
}
