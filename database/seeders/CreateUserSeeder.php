<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        User::create([
            'name' => 'System Admin',
            'username' => 'sysadmin',
            'created_at' => now(),
            'user_type' => 'Admin',
            'password' => bcrypt('Kenya@987'),
        ]);
    }
}
