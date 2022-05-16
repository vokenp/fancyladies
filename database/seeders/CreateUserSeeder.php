<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $defaultPswd = config('app.DefaultPassword');
        $items =  [
            [
                'name' => 'System Admin',
                'username' => 'sysadmin',
                'created_at' => now(),
                'user_type' => 'Admin',
                'password' => bcrypt('Kenya@987'),

            ],
            [
                'name' => 'Guest User',
                'username' => 'guest',
                'created_at' => now(),
                'user_type' => 'Admin',
                'password' => bcrypt($defaultPswd),
            ],
            [
                'name' => 'Guest User2',
                'username' => 'guest2',
                'created_at' => now(),
                'user_type' => 'Admin',
                'password' => bcrypt($defaultPswd),
              ]
          ];
       
         foreach ($items as $item) {
             $userName = $item["username"];
            $checkExist = User::where('username', $userName)->exists();
            if(!$checkExist)
            {
                User::create($item);
            }
           
         }
       
    }
}
