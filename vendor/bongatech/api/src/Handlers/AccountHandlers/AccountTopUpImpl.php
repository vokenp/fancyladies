<?php


namespace BongaTech\Api\Handlers\AccountHandlers;


use BongaTech\Api\Handlers\BongaHandler;

class AccountTopUpImpl extends BongaHandler
{
    public function process()
    {
        $method = $this->getMethod();
        return $this->$method();
    }
}
