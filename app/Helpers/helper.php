<?php

use App\Models\BongaSmsout;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;



// BongaTech Send Single

if(!function_exists('sendSMS'))
{
    function sendSMS($sendMsg)
    {
        $instance =  new BongaTech(config('app.BongaToken'));
        
        $sendMsg['correlator'] = getNextId('bonga_smsouts');
        $sendMsg['short_code'] = config('app.BShortCode');
            $items =  [
                [
                  'short_code' => $sendMsg["short_code"],
                  'phone' => $sendMsg["phone"],
                  'message' => $sendMsg["message"],
                  'sms_length' => strlen($sendMsg["message"]),
                  'correlator' => $sendMsg["correlator"],
                  'created_by' =>Auth::id(),
                  'created_at' => now()
                ]
              ];
             DB::table('bonga_smsouts')->insert($items);

          $sms = new Sms($sendMsg['short_code'], $sendMsg['phone'],  $sendMsg['message'],  $sendMsg['correlator']);
          $response = $instance->sendSMS($sms);
          if ($response['status']) {
            $responseitems =  [
                  'send_status' => 'success',
                  'uniqueId' => $response["data"]["uniqueId"],
                  'sms_units' =>  $response["data"]["sms_units"],
                  'response_message' =>  $response["message"],
                  'updated_at' => now()  
              ];
          }
          else
          {
            $responseitems =  [
                'send_status' => 'error',
                'sms_units' =>  0,
                'uniqueId' => $response["data"]["uniqueId"],
                'response_message' =>  $response["message"],
                'formatted_status' =>  $response["data"]["remarks"],
                'batch_id' => $response["data"]["batch_id"],
                'total_price' => $response["data"]["total_price"],
                'unit_price' => $response["data"]["unit_price"],
                'updated_at' => now()  
            ];
          }
          DB::table('bonga_smsouts')->where('correlator', $sendMsg['correlator'])->update($responseitems);
          return $response;
    }
}

if(!function_exists('sendBatchSMS'))
{
    function sendBatchSMS($Msgs)
    {
        $createdListID = array();
        $instance =  new BongaTech(config('app.BongaToken'));
        $smslist = array();
        foreach ($Msgs as $key => $msg) {
            $sendMsg = array();
            $nextID = getNextId('bonga_smsouts');
            $sendMsg['correlator'] = $nextID;
            $sendMsg['short_code'] = config('app.BShortCode');
            $sendMsg["phone"] = $msg["phone"];
            $sendMsg["message"] = $msg["message"];
            $createdListID[] = $sendMsg['correlator'];
            $composed_sms_id = isset($msg["composedSMSID"]) ? $msg["composedSMSID"] : "";

            $items =  [
                  'short_code' => $sendMsg["short_code"],
                  'phone' => $sendMsg["phone"],
                  'message' => $sendMsg["message"],
                  'sms_length' => strlen($sendMsg["message"]),
                  'correlator' => $nextID,
                  'composed_sms_id' => $composed_sms_id,
                  'created_by' => Auth::id(),
                  'created_at' => now()
              ];

            DB::table('bonga_smsouts')->insert($items);
           
          
            $smslist[] = new Sms($sendMsg['short_code'], $sendMsg['phone'],  $sendMsg['message'],  $sendMsg['correlator']);
        }

        $Multiresponse = call_user_func_array(array($instance, 'sendBatchSMS'), $smslist);

        foreach ($Multiresponse as $key => $response) {
            if ($response['status']) {
                $responseitems =  [
                      'send_status' => 'success',
                      'uniqueId' => $response["data"]["uniqueId"],
                      'sms_units' =>  $response["data"]["sms_units"],
                      'response_message' =>  $response["message"],
                      'updated_at' => now()  
                  ];
                  DB::table('bonga_smsouts')->where('id', $response["data"]['correlator'])->update($responseitems);
              }
              elseif(!$response['status'] && isset($response['data']))
              {
                $responseitems =  [
                    'send_status' => 'error',
                    'sms_units' =>  0,
                    'uniqueId' => $response["data"]["uniqueId"],
                    'response_message' =>  $response["message"],
                    'formatted_status' =>  $response["data"]["remarks"],
                    'batch_id' => $response["data"]["batch_id"],
                    'total_price' => $response["data"]["total_price"],
                    'unit_price' => $response["data"]["unit_price"],
                    'updated_at' => now()  
                ];
                DB::table('bonga_smsouts')->where('id', $response["data"]['correlator'])->update($responseitems);
              }
              elseif(!$response['status'] && !isset($response['data']))
              {
                  foreach ($createdListID as $ckey => $crID) {
                    $responseitems =  [
                        'send_status' => 'SysError',
                        'response_message' =>  $response["message"],
                        'updated_at' => now()  
                    ];
                    DB::table('bonga_smsouts')->where('id', $crID)->update($responseitems);
                  }

              }
             
        }
        return $Multiresponse;
    }
}

// GEt SMS Balance 
if(!function_exists('getSmsBalance'))
{
    function getSmsBalance()
    {
        $token = config('app.BongaToken'); //replace with your Token from the portal
        $version = "v1"; //DONT change unless you are using a different version
        $instance = new BongaTech($token, $version);

        //Check Account Balance
        $response = $instance->accountBalance();
        return $response;
    }
}

//   Get Table Next ID
if(!function_exists('getNextId'))
{
    function getNextId($table) 
    {
        $statement = DB::select("show table status like '$table'");
        return $statement[0]->Auto_increment;
    }
}



if(!function_exists('formatPhoneNumber'))
{
    function formatPhoneNumber($pnum) {
        $pnum   = preg_replace('/[^0-9]/','',$pnum); // Numbers Only
        $strlen = strlen($pnum);
        $PerfNum = array();
        $revstr =strrev($pnum) ;
        $split = str_split($revstr,3) ;
        ksort($split);
   
        //array_walk($split,"unrev");
   
        foreach($split as &$value) {
         $value = strrev($value);
        }
   
        if($strlen == 12)
        {
          $countryCode = $split[3] == 254 ? 254 : 999;
          $NDC = $split[2];
          $subsnumber = $split[1].$split[0];
   
          $PerfNum["ErrorCode"] = $countryCode == 999 ? "Invalid" : "Valid";
          $PerfNum["NumType"] = "PhoneNo";
          $PerfNum["MSISDN"] = $PerfNum["ErrorCode"] == "Valid" ?  $countryCode.$NDC.$subsnumber : $pnum;
        }
        elseif($strlen == 10)
        {
          $countryCode = $split[3] == 0 ? 254 : 999;
          $NDC     = $split[2];
          $subsnumber   = $split[1].$split[0];
   
          $PerfNum["ErrorCode"] = $countryCode == 999 ? "Invalid" : "Valid";
          $PerfNum["NumType"] = "PhoneNo";
          $PerfNum["MSISDN"] = $PerfNum["ErrorCode"] == "Valid" ?  $countryCode.$NDC.$subsnumber : $pnum;
        }
        elseif($strlen == 9)
        {
         $netPrefix = array(1,7);
          $countryCode =  in_array(substr($split[2],0,1),$netPrefix) ? 254 : 999;
          $NDC     = $split[2];
          $subsnumber   = $split[1].$split[0];
   
          $PerfNum["ErrorCode"] = $countryCode == 999 ? "Invalid" : "Valid";
          $PerfNum["NumType"] = "PhoneNo";
          $PerfNum["MSISDN"] = $PerfNum["ErrorCode"] == "Valid" ?  $countryCode.$NDC.$subsnumber : $pnum;
        }
        elseif($strlen == 11)
        {
          $PerfNum["ErrorCode"] =  "Valid";
          $PerfNum["NumType"] = "TokenNo";
          $PerfNum["MSISDN"] =  $pnum;
        }
        else
        {
         $PerfNum["ErrorCode"] =  "InValid";
         $PerfNum["NumType"] = "NA";
         $PerfNum["MSISDN"] =  $pnum;
        }

     return  $PerfNum["MSISDN"];
     }
}

// if(!function_exists('getMNO'))
// {
//     function getMNO($MNOCode)
// {

//   $networks = array("SafCom"=>4,"Airtel"=>1,"Telkom"=>2);
//   $MNOList = DB::table('mobiareacodes')->where('MNO_Prefix',$MNOCode)->select('MobileNetOperator')->pluck('MobileNetOperator')->first();
//   $MNOName = $MNOList;
  
//   return $MNOName;
// }
// }


// Get list Items 
if (!function_exists('getListItems')) {
    function getListItems($itemType)
    {
        $list = DB::table('listitems')->select('item_code','item_type','item_description')->where('item_type',$itemType)->get();
           return $list;
    }
}

//Get List of Model

if(!function_exists('getModels'))
{
function getModels(): Collection
{
    $models = collect(File::allFiles(app_path()))
        ->map(function ($item) {
            $path = $item->getRelativePathName();
            $class = sprintf('\%s%s',
                Container::getInstance()->getNamespace(),
                strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));

            return $class;
        })
        ->filter(function ($class) {
            $valid = false;

            if (class_exists($class)) {
                $reflection = new \ReflectionClass($class);
                $valid = $reflection->isSubclassOf(Model::class) &&
                    !$reflection->isAbstract();
            }

            return $valid;
        });

    return $models->values();
}
}

   
  


  if (!function_exists('getModCols')) {
      function getModCols($table,$moduleID,$parentTbl)
      {
        $table = strtolower($table); 
        if (endsWith($table,'s') == false) 
        {
          $table = $table."s";
          }

          if (!Schema::hasTable($table)) {
            $table = $parentTbl;
          }
        
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $list = array('field_name','display_name','display_order','is_searchable');
        $modViewlist = DB::table('moduleviews')->select('field_name','display_name','display_order','is_searchable')->where('module_id',$moduleID)->get();
        //array_shift($columns);
        
        $listView = [];
          for ($i=0; $i < count($columns); $i++) { 
              if($columns[$i] == "id")
              {
                continue;
              }
            $listView[$columns[$i]] = array('field_name' => $columns[$i],'display_name'=> '','display_order' => '','is_searchable' => '');
          }
            
          if (!$modViewlist->isEmpty()){
             foreach ($modViewlist as   $modView) {
                $listView[$modView->field_name] = array('field_name' => $modView->field_name,'display_name'=> $modView->display_name,'display_order' => $modView->display_order,'is_searchable' => $modView->is_searchable);
             }
          }
        return $listView;
      }
  }


  if(!function_exists('endsWith'))
   {
    function endsWith($FullStr, $needle)
    {
        $StrLen = strlen($needle);
        $FullStrEnd = substr($FullStr, strlen($FullStr) - $StrLen);
        return $FullStrEnd == $needle;
    }
   }

