<?php


namespace BongaTech\Api\Handlers\AccountHandlers;

trait AccountHandler
{
    public function accountBalance()
    {
        $uri = "$this->version/account/balance";
        try {
            return (new AccountBalanceImpl($this->token, $uri))->process();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function accountTopUp(string $amount, string $account_id, string $topup_reference = null)
    {
        $uri = "$this->version/account/top-up";
        try {
            $data = [
                "amount"=>$amount,
                "account_id"=>$account_id,
                "topup_reference"=>$topup_reference
            ];
            return (new AccountTopUpImpl($this->token, $uri, $data))->process();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
