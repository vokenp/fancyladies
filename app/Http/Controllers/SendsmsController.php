<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;
use Event;
use App\Events\SendSMS;

class SendsmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $instance;

    public function __construct()
    {
        $this->instance =  new BongaTech(config('app.BongaToken'));
    }

    public function index()
    {
        //  $rand = rand();
        // $message = "The Gospel is real $rand";
        // $phone = formatPhoneNumber("0101283064") ;
        // $msg = array("phone" => $phone, "message" =>$message);
        // $response = sendSMS($msg);

        //$response = getSmsBalance();

        Event::dispatch(new SendSMS(41));
        dd("Kenya");
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
