<?php

namespace App\Listeners;

use App\Events\SendSMS;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Models\ComposedSms;
use Event;

class SendComposedSMS implements ShouldQueue
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
            $msg[] = array("phone" => formatPhoneNumber($val),"message"=> $messageBody,"composedSMSID" => $smsInfo["id"]);
        }

        $response = sendBatchSMS($msg);
        $this->doUpdateTable($smsInfo["id"]);
    }

    // public function doCustomer($smsInfo)
    // {
    //    // $distributionList = $smsInfo["distribution_list"];
    //     //$messageBody = $smsInfo["message_body"];

    //     // if ($distributionList == 'All') {
    //     //   $AllCustomers = DB::table('customers')->select('id','customer_phoneno')->get();
    //     //   $custlist = array();
    //     //     foreach($AllCustomers as $list)
    //     //     {
    //     //       $phoneNo = str_replace('-','',$list["customer_phoneno"]);
    //     //       $custlist[] =  array("phone" => formatPhoneNumber($phoneNo),"message"=> $messageBody,"ExtraName" => "Customers","ExtraID" => $list["id"]);
    //     //     }
    //     //     $distChuck = array_chunk($custlist, 99);
    //     //     foreach($distChuck  as $distList){
    //     //       $response = sendBatchSMS($distList);
    //     //     } 
    //     // }

    //     $this->doUpdateTable($smsInfo["id"]);
    // }

    public function doCustomerList($smsInfo)
    {
           
      $this->doUpdateTable($smsInfo["id"]);
    }

    public function doEmployeeList($smsInfo)
    {
       $this->doUpdateTable($smsInfo["id"]);
    }
  


    public function doUpdateTable($smsID)
    {
      $updateItem = array();
      $updateItem["send_status"] = 'Sent';
      $updateItem["updated_at"] = now();
      DB::table('composed_sms')->where('id', $smsID)->update($updateItem);
    }

    public function handle(SendSMS $event)
    {
        $smsInfo = ComposedSms::find($event->ComposedID)->toArray();
        
        $sendCategory = $smsInfo["send_category"];

         switch ($sendCategory) {
             case 'FreeNums':
                 $this->doFreeNums($smsInfo);
                 break;
              case 'Customers':
                $this->doCustomerList($smsInfo);
             case 'Employees':
                $this->doEmployeeList($smsInfo);
             default:
                 
                 break;
         }
    }
}
