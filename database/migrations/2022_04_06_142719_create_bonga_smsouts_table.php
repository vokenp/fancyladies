<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBongaSmsoutsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "bonga_smsouts";
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


            if (!Schema::hasColumn($tableName,'send_status')) {
                $table->string('send_status')->default('pending');
            }

            if (!Schema::hasColumn($tableName,'response_message')) {
                $table->string('response_message')->nullable();
            }

            if (!Schema::hasColumn($tableName,'short_code')) {
                $table->string('short_code')->nullable();
            }

            if (!Schema::hasColumn($tableName,'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn($tableName,'message')) {
                $table->text('message')->nullable();
            }

            if (!Schema::hasColumn($tableName,'correlator')) {
                $table->string('correlator')->unique();
            }

            if (!Schema::hasColumn($tableName,'uniqueId')) {
                $table->string('uniqueId')->nullable();
            }

            if (!Schema::hasColumn($tableName,'sms_units')) {
                $table->integer('sms_units')->nullable();
            }

            if (!Schema::hasColumn($tableName,'sms_length')) {
                $table->integer('sms_length')->nullable();
            }

            if (!Schema::hasColumn($tableName,'batch_id')) {
                $table->string('batch_id')->nullable();
            } 
            
            if (!Schema::hasColumn($tableName,'unit_price')) {
                $table->integer('unit_price')->nullable();
            }

            if (!Schema::hasColumn($tableName,'total_price')) {
                $table->integer('total_price')->nullable();
            }

            if (!Schema::hasColumn($tableName,'link_id')) {
                $table->string('link_id')->nullable();
            } 

            if (!Schema::hasColumn($tableName,'formatted_status')) {
                $table->string('formatted_status')->nullable();
            } 

            if (!Schema::hasColumn($tableName,'deliveryStatus')) {
                $table->string('deliveryStatus')->nullable();
            } 

            if (!Schema::hasColumn($tableName,'deliveryTime')) {
                $table->timestamp('deliveryTime')->nullable();
            } 

            if (!Schema::hasColumn($tableName,'receiver_category')) {
                $table->string('receiver_category')->nullable()->default('FreeNum');
            } 

            if (!Schema::hasColumn($tableName,'receiver_id')) {
                $table->integer('receiver_id')->nullable();
            } 
    
        });
    }
}
