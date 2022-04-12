<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->rememberToken();
            });
            $this->addColumns();
        }
        else
        {
            $this->addColumns();
        }

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->addColumns();
        
    }

    private function addColumns()
    {
        Schema::table('users', function (Blueprint $table) {
            
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable();
            }

            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique();
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('users', 'password')) {
                $table->string('password');
            }

            if (!Schema::hasColumn('users', 'user_type')) {
                $table->string('user_type')->nullable()->default('Member');
            }

            if (!Schema::hasColumn('users', 'phoneno')) {
                $table->string('phoneno')->nullable();
            }

            if (!Schema::hasColumn('users', 'active_status')) {
                $table->boolean('active_status')->nullable()->default(true);
            }

            if (!Schema::hasColumn('users', 'level')) {
                $table->integer('level')->nullable()->default('1');
            }

        });
    }
}
