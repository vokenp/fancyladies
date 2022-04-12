<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenucategoriesTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "menucategories";
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

            if (!Schema::hasColumn($tableName,'menu_title')) {
                $table->string('menu_title')->nullable();
            }

            if (!Schema::hasColumn($tableName,'menu_icon')) {
                $table->string('menu_icon')->nullable();
            }


            if (!Schema::hasColumn($tableName,'menu_bullet')) {
                $table->string('menu_bullet')->nullable();
            }

            if (!Schema::hasColumn($tableName,'menu_isroot')) {
                $table->boolean('menu_isroot')->default(false);
            }

            if (!Schema::hasColumn($tableName,'menu_opennewtab')) {
                $table->boolean('menu_opennewtab')->default(false);
            }

            if (!Schema::hasColumn($tableName,'menu_section')) {
                $table->string('menu_section')->nullable();
            }
    
        });
    }
}
