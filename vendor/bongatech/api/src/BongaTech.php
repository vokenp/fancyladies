<?php


namespace BongaTech\Api;


use BongaTech\Api\Handlers\AccountHandlers\AccountHandler;
use BongaTech\Api\Handlers\SmsHandlers\SMSHandler;

class BongaTech
{
    use SMSHandler, AccountHandler;


    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $version;


    /**
     * BongaTech constructor.
     * @param string $token
     * @param string $version
     */
    public function __construct(string $token, string $version = 'v1')
    {
        $this->token = $token;
        $this->version = $version;
    }
}
