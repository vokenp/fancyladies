<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MpesaTransaction;
use App\Models\skelton;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LogMpesaTransactionController extends Controller
{
    public function index()
    {
        
    }

    public function confirmMPTrans(Request $request)
    {
        $req = $request->all();
        $items =  [   
              'def_text' => json_encode($req),
              'def_colomn' => rand()
          ];
        skelton::create($items);


        $CustPhoneNo = $request->MSISDN;
        $TransAmount = $request->TransAmount;
        $TransActionDate = date('d-M-Y g:i A', strtotime(now()));
        $TransID = $request->TransID;
        $OrgAccountBalance = $request->OrgAccountBalance;
        $custFirstName = $request->FirstName;

        $adminPhoneNo = config('app.AdminPhoneNo');

        $chunks = $chunks = str_split($CustPhoneNo, 3);
        $formattedPhoneNo = implode('-',$chunks);
        $custFullName = $request->FirstName.' '.$request->MiddleName.' '.$request->LastName;
        $custCode = $request->FirstName.'-'.$CustPhoneNo;
        $checkExist = Customer::where('customer_code', $custCode)->exists();

        $alertMsg = "$custFullName \rTel: $CustPhoneNo \rPaid: Ksh $TransAmount  \rDate: $TransActionDate \rRefNo: $TransID \rBalance : Ksh $OrgAccountBalance";

        $customerMsg = "Hi $custFirstName your payment TransRef: $TransID of Ksh $TransAmount, has been received.\rThank you for your Support";

        $msg = array();
        $msg[] = array("phone" => $adminPhoneNo,"message" => $alertMsg,"composedSMSID" => 0);
       // $msg[] = array("phone" => $CustPhoneNo,"message" => $customerMsg,"composedSMSID" => 0);

        if(!$checkExist)
        {
            $OrgName = config('app.name');
            $customerWelcomeMsg = "Hi $custFirstName welcome to $OrgName Family we are Pleased to have you onboard.\rFor Booking and Inquiries reach us via +$adminPhoneNo";
           $custData = array();
           $custData["customer_phoneno"] = $formattedPhoneNo;
           $custData["customer_name"] = $custFullName;
           $custData["customer_code"] = $custCode;
           Customer::create($custData);
           //$msg[] = array("phone" => $CustPhoneNo,"message" => $customerWelcomeMsg,"composedSMSID" => 0);
        }
        sendBatchSMS($msg);
        MpesaTransaction::create($request->all());
    }



    public function  validatemptransaction(Request $request)
    {
       $response = array();
       $response["ResultCode"] = 0;
       $response["ResultDesc"] = "Success";
       $response["ThirdPartyTransID"] = rand();

       return $response;
    }
}
