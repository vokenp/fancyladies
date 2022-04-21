<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesItemlistsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "sales_itemlists";
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

            if (!Schema::hasColumn($tableName,'sales_order_id')) {
                $table->foreignId('sales_order_id')->nullable()->constrained('sales_order')->cascadeOnDelete();
            }

            if (!Schema::hasColumn($tableName,'shop_service_id')) {
                $table->foreignId('shop_service_id')->nullable()->constrained('shop_services');
            }

            if (!Schema::hasColumn($tableName,'employee_id')) {
                $table->foreignId('employee_id')->nullable()->constrained('employees');
            }

            if (!Schema::hasColumn($tableName,'item_amt_expected')) {
                $table->decimal('item_amt_expected')->nullable();
            }

            if (!Schema::hasColumn($tableName,'item_amt_paid')) {
                $table->decimal('item_amt_paid')->nullable();
            }

            if (!Schema::hasColumn($tableName,'item_quantity')) {
                $table->integer('item_quantity')->nullable();
            }

            if (!Schema::hasColumn($tableName,'item_total')) {
                $table->integer('item_total')->nullable();
            }

            if (!Schema::hasColumn($tableName,'item_discount')) {
                $table->integer('item_discount')->nullable()->default(0);
            }
    
        });
    }
}
