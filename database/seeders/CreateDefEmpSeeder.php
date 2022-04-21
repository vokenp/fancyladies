<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class CreateDefEmpSeeder extends Seeder
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
                'employee_name' => 'Staff 001',
                'employee_idno' => '10120200',
                'employee_phoneno' => '254-701-100-100'
            ]
          ];
       
         foreach ($items as $item) {
             $employee_idno = $item["employee_idno"];
            $checkExist = Employee::where('employee_idno', $employee_idno)->exists();
            if(!$checkExist)
            {
                Employee::create($item);
            }
           
         }
    }
}
