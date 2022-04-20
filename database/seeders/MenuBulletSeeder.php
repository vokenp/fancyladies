<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ListItem;
class MenuBulletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $itemType = "MenuBullet";
        ListItem::where('item_type', $itemType)->delete();
        $items =  [
            [
              'item_type' => $itemType,
              'item_code' => 'dot',
              'item_description' => 'dot',
             
            ],
            [
                'item_type' => $itemType,
                'item_code' => 'line',
                'item_description' => 'line',
                
              ]
          ];

          foreach ($items as $item) {
            $itemType = $item["item_type"];
            $itemCode = $item["item_code"];
            $checkExist = ListItem::where([['item_type',$itemType],['item_code',$itemCode]])->exists();
            if(!$checkExist)
            {
                DB::table('listitems')->insert($item);
            }
          }

        
    }
}
