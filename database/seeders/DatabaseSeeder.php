<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);
    	foreach (range(1,5000) as $index) {
            DB::table('members')->insert([
                'member_name' => $faker->name($gender),
                'member_no' => 'CFF00'.$faker->unique()->numberBetween($min = 1, $max = 5000),
                'member_dob' => $faker->dateTimeBetween('1980-01-01', '2012-12-31')->format('Y-m-d'),
                'member_idno' => $faker->randomDigit,
                'member_martialstatus' => $faker->randomElement(['Married', 'single','Divorsed']),
                'member_phoneno' => $faker->phoneNumber(),
                'member_email' => $faker->email(),
                'member_gender' => $faker->randomElement(['male', 'female'])
                
            ]);
        }
    }
}
