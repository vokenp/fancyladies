<?php


namespace BongaTech\Api\Handlers;

use BongaTech\Api\Exceptions\BongaException;
use BongaTech\Api\Models\Sms;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

abstract class BongaHandler
{
    const BASE_URL = "http://bulk.bongatech.com/api/";
    //const BASE_URL = "http://127.0.0.1:8000/api/";

    const METHOD_POST = "sendPostRequest";
    const METHOD_GET = "sendGetRequest";

    /**
     * @var string
     */
    protected $token;

    protected $data;

    protected $uri;

    protected $method;

    /**
     * BongaHandler constructor.
     * @param string $token
     * @param $data
     * @param $uri
     * @throws \Exception
     */
    public function __construct(string $token, string $uri, $data = null)
    {
        $this->token = $token;
        $this->data = $data;
        $this->uri = $uri;
    }

    protected function getMethod()
    {
        return self::METHOD_POST;
    }

    public function process()
    {
        foreach ($this->data as $index => $message) {
            $this->validate($index, $message);
        }
        $method = $this->getMethod();
        return $this->$method();
    }


    protected function constructHeader(): array
    {
        return [
            "Content-type" => "application/json",
            "Accept" => "application/json",
            "Authorization" => "Bearer $this->token"
        ];
    }

    protected function sendPostRequest()
    {
        $client = new Client();
        try {
            $results = $client->post(
                self::BASE_URL . $this->uri,
                [
                    RequestOptions::JSON => $this->data,
                    RequestOptions::HEADERS => $this->constructHeader()
                ]
            );
            return json_decode($results->getBody(), true);
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody(), true);
        }
    }

    protected function sendGetRequest()
    {
        $client = new Client();
        try {
            $results = $client->get(
                self::BASE_URL . $this->uri,
                [
                    RequestOptions::HEADERS => $this->constructHeader(),
                    RequestOptions::QUERY => $this->data
                ]
            );
            return json_decode($results->getBody(), true);
        } catch (RequestException $exception) {
            return json_decode($exception->getResponse()->getBody(), true);
        }
    }

    protected function validate(int $index, Sms $message)
    {
        if (!$message->getSender()) {
            throw new \Exception("Sender is Required \n");
        }
        if (!$message->getPhone()) {
            throw new \Exception("Phone Number is Required \n");
        }
        if (!$message->getMessage()) {
            throw new \Exception("Message is Required \n");
        }
    }
}
