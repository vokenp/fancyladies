<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaTransactionsTable extends Migration
{
    public $tblName;

    public function __construct()
    {
        $this->tblName = "mpesa_transactions";
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

            if (!Schema::hasColumn($tableName,'TransactionType')) {
                $table->string('TransactionType')->nullable();
            }

            if (!Schema::hasColumn($tableName,'TransID')) {
                $table->string('TransID')->nullable()->unique();
            }

            if (!Schema::hasColumn($tableName,'TransTime')) {
                $table->string('TransTime')->nullable();
            }

            if (!Schema::hasColumn($tableName,'TransAmount')) {
                $table->decimal('TransAmount')->nullable();
            }

            if (!Schema::hasColumn($tableName,'BusinessShortCode')) {
                $table->string('BusinessShortCode')->nullable();
            }

            if (!Schema::hasColumn($tableName,'BillRefNumber')) {
                $table->string('BillRefNumber')->nullable();
            }

            if (!Schema::hasColumn($tableName,'InvoiceNumber')) {
                $table->string('InvoiceNumber')->nullable();
            }

            if (!Schema::hasColumn($tableName,'OrgAccountBalance')) {
                $table->decimal('OrgAccountBalance')->nullable();
            }

            if (!Schema::hasColumn($tableName,'ThirdPartyTransID')) {
                $table->string('ThirdPartyTransID')->nullable();
            }

            if (!Schema::hasColumn($tableName,'MSISDN')) {
                $table->string('MSISDN')->nullable()->index();
            }

            if (!Schema::hasColumn($tableName,'FirstName')) {
                $table->string('FirstName')->nullable();
            }

            if (!Schema::hasColumn($tableName,'MiddleName')) {
                $table->string('MiddleName')->nullable();
            }

            if (!Schema::hasColumn($tableName,'LastName')) {
                $table->string('LastName')->nullable();
            }
    
        });
    }
}
