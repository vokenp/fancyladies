<?php


namespace BongaTech\Api\Models;


class Sms implements \JsonSerializable
{
    protected $sender;
    protected $phone;
    protected $message;
    protected $correlator;
    protected $link_id;
    protected $end_point;

    /**
     * Sms constructor.
     * @param $sender
     * @param $phone
     * @param $message
     * @param $correlator
     * @param $link_id
     * @param $end_point
     */
    public function __construct($sender, $phone, $message, $correlator = null, $link_id = null, $end_point = null)
    {
        $this->sender = $sender;
        $this->phone = $phone;
        $this->message = $message;
        $this->correlator = $correlator;
        $this->link_id = $link_id;
        $this->end_point = $end_point;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return null
     */
    public function getCorrelator()
    {
        return $this->correlator;
    }

    /**
     * @param null $correlator
     */
    public function setCorrelator($correlator): void
    {
        $this->correlator = $correlator;
    }

    /**
     * @return null
     */
    public function getLinkId()
    {
        return $this->link_id;
    }

    /**
     * @param null $link_id
     */
    public function setLinkId($link_id): void
    {
        $this->link_id = $link_id;
    }

    /**
     * @return null
     */
    public function getEndPoint()
    {
        return $this->end_point;
    }

    /**
     * @param null $end_point
     */
    public function setEndPoint($end_point): void
    {
        $this->end_point = $end_point;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'sender'=>$this->getSender(),
            'phone'=>$this->getPhone(),
            'message'=>$this->getMessage(),
            'correlator'=>$this->getCorrelator(),
            'link_id'=>$this->getLinkId(),
            'endpoint'=>$this->getEndPoint()
        ];
    }
}
