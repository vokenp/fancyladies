<?php
require_once '../vendor/autoload.php';

use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;

/*
    |--------------------------------------------------------------------------
    | Initiate a New BongaTech Instance
    |--------------------------------------------------------------------------
    |
    | REMEMBER to import the namespaces above to ensure code runs OK
    | or
    | Append the full namespaced path the the relevant class ....i.e BongaTech\Api\BongaTech
    |
    |TOKENS can be generated from your account, under the integrations tab.
    |BongaTech() takes in two parameters, a MANDATORY token and optional api version
    |sendSMS() takes in an SMS() Object.
    |
    */
$token = "Token_string"; //replace with your Token from the portal
$version = "v1"; //DONT change unless you are using a different version
$instance = new BongaTech($token, $version);

//create multiple Sms Object(s)
/*
 * SMS Object parameters are:
 * sender(required)
 * phone(required)
 * message(required)
 * correlator(optional)
 * link_id(optional)
 * endpoint(optional)
 *
 * Consult API Document for detailed explanation
 */
$sms1= new Sms("BONGATECH", "0716079675", "Test Message 1", "101");
$sms2 = new Sms("BizTxt", "0716079675", "Test Message 2", "102");

//send Sms object
$response = $instance->sendBatchSMS($sms1, $sms2);

//invoke multiple
//call_user_func_array https://www.php.net/manual/en/function.call-user-func-array.php

var_dump($response);
