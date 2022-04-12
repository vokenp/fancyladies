<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopServicesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "shop_services";
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

            if (!Schema::hasColumn($tableName,'service_name')) {
                $table->string('service_name')->nullable();
            }

            if (!Schema::hasColumn($tableName,'service_description')) {
                $table->string('service_description')->nullable();
            }

            if (!Schema::hasColumn($tableName,'service_price')) {
                $table->decimal('service_price')->nullable();
            }

            if (!Schema::hasColumn($tableName,'service_commission')) {
                $table->integer('service_commission')->nullable();
            }
    
        });
    }
}
