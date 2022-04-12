<?php


namespace BongaTech\Api\Handlers\AccountHandlers;

use BongaTech\Api\Handlers\BongaHandler;

class AccountBalanceImpl extends BongaHandler
{
    /**
     * @return mixed
     */
    public function getMethod()
    {
        return self::METHOD_GET;
    }

    public function process()
    {
        $method = $this->getMethod();
        return $this->$method();
    }
}
