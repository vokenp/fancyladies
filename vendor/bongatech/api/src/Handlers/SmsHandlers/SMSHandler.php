<?php


namespace BongaTech\Api\Handlers\SmsHandlers;


use BongaTech\Api\Exceptions\BongaException;
use BongaTech\Api\Models\Sms;

trait SMSHandler
{
    /**
     * @param Sms $sms
     * @return mixed|string
     */
    public function sendSMS(Sms $sms)
    {
        $uri = "$this->version/send-sms";
        try {
            return (new SMSHandlerImpl($this->token, $uri, $sms))->process();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Sms ...$messages
     * @return mixed|string
     */
    public function sendBatchSMS(Sms ...$messages)
    {
        $uri = "$this->version/send-sms";
        try {
            return (new SMSHandlerImpl($this->token, $uri, $messages))->process();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
