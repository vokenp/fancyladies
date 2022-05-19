<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGetuinfoFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $functionSQL = <<< SQL
        DROP FUNCTION IF EXISTS getuinfo;
        CREATE FUNCTION getuinfo(UserID int) RETURNS varchar(255)
            DETERMINISTIC
        BEGIN
             DECLARE FullName VARCHAR(255);
              select concat(name,concat(' (',username,')')) into FullName from users where id = UserID;
             RETURN FullName;
            END;

        SQL;
        DB::unprepared($functionSQL);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS `getuinfo`;');
    }
}
