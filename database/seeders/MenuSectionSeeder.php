<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ListItem;

class MenuSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemType = "MenuSection";
        ListItem::where('item_type', $itemType)->delete();
        $items =  [
            [
              'item_type' => 'MenuSection',
              'item_code' => 'General',
              'item_description' => 'General',
             
            ],
            [
                'item_type' => 'MenuSection',
                'item_code' => 'Reports',
                'item_description' => 'Reports',
                
            ],
            [
                'item_type' => 'MenuSection',
                'item_code' => 'Communication',
                'item_description' => 'Communication',
                
            ],
              [
                'item_type' => 'MenuSection',
                'item_code' => 'Finance',
                'item_description' => 'Finance',
                
              ]
          ];

          DB::table('listitems')->insert($items);
    }
}
