<?php

namespace App\Listeners;

use App\Events\SendSMS;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\ComposedSms;
use Event;

class SendComposedSMS
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function doFreeNums($smsInfo)
    {
        $distributionList = json_decode($smsInfo["distribution_list"]);
        
        $messageBody = $smsInfo["message_body"];
        $msg = array();
        foreach ($distributionList as $key => $val) {
            $msg[] = array("phone" => formatPhoneNumber($val),"message"=> $messageBody);
        }

        $response = sendBatchSMS($msg);

      $updateItem = array();
      $updateItem["send_status"] = 'Sent';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsInfo["id"])->update($updateItem);
    }


    public function doInterimMembers($smsInfo)
    {


      $updateItem = array();
      $updateItem["send_status"] = 'Sent';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsInfo["id"])->update($updateItem);
    }

    public function doMembers($smsInfo)
    {


      $updateItem = array();
      $updateItem["send_status"] = 'Sent';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsInfo["id"])->update($updateItem);
    }

    public function doChurchGroups($smsInfo)
    {


      $updateItem = array();
      $updateItem["send_status"] = 'Sent';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsInfo["id"])->update($updateItem);
    }


    public function doTempGroups($smsInfo)
    {


      $updateItem = array();
      $updateItem["send_status"] = 'Sorted';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsInfo["id"])->update($updateItem);
    }

    public function handle(SendSMS $event)
    {
        $smsInfo = ComposedSms::find($event->ComposedID)->toArray();
        
        $sendCategory = $smsInfo["send_category"];

         switch ($sendCategory) {
             case 'FreeNums':
                 $this->doFreeNums($smsInfo);
                 break;
             case 'InterimMembers':
                 $this->doInterimMembers($smsInfo);
                 break;
             case 'Members':
                 $this->doMembers($smsInfo);
                 break;
             case 'ChurchGroups':
                  $this->doChurchGroups($smsInfo);
                  break;
             case 'TempGroups':
                  $this->doTempGroups($smsInfo);
                  break;
             default:
                 
                 break;
         }
    }
}
