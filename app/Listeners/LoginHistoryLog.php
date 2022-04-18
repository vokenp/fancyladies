<?php

namespace App\Listeners;

use App\Events\loginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Event;
use Session;

class LoginHistoryLog
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

    /**
     * Handle the event.
     *
     * @param  \App\Events\loginHistory  $event
     * @return void
     */
    public function handle(loginHistory $event)
    {
      $userInfo = $event->user;

      $userItem = array();
      $userItem["user_id"] = $userInfo->id;
      $userItem["created_at"] = now();
      $userItem["login_date"] = now();
      $userItem["login_host"] = $_SERVER['REMOTE_ADDR'];
      $userItem["login_agent"] = $_SERVER['HTTP_USER_AGENT'];
      $userItem["login_sessionid"] = session()->getId();
      DB::table('login_history')->insert($userItem);
    }
}
