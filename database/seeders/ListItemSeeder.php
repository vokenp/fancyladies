<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListItem;
class ListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $strlist = file_get_contents("listitems.txt",true);
        $items = json_decode($strlist,true);
        
          foreach ($items as $item) {
            $itemType = $item["item_type"];
            $itemCode = $item["item_code"];
            $checkExist = ListItem::where([['item_type',$itemType],['item_code',$itemCode]])->exists();
            if(!$checkExist)
            {
                ListItem::create($item);
            }
          }

    }
}
