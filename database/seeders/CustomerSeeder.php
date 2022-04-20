<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items =  [
            [
                'customer_name' => 'WalkIn Customer',
                'customer_phoneno' => '254-700-001-001',
                'customer_email' => 'test@gmail.com',
                'created_at' => now()
              ]
          ];
       
          foreach ($items as $item) {
            $customerName = $item["customer_name"];
            $checkExist = Customer::where('customer_name',$customerName)->exists();
            if(!$checkExist)
            {
                Customer::create($item);
            }
          }
       
    }

}