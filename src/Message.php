<?php

namespace Comsolit\ImasysPhp;

class Message
{
    private $messageId;

    private $status;

    private $notificationMessage;

    private $deliveryTimeStamp;

    private $errorCode;

    private $errorDescription;

    function __construct($messageId, $status, $notificationMessage, $deliveryTimeStamp, $errorCode, $errorDescription)
    {
        $this->messageId           = $messageId;
        $this->status              = $status;
        $this->notificationMessage = $notificationMessage;
        $this->deliveryTimeStamp   = $deliveryTimeStamp;
        $this->errorCode           = $errorCode;
        $this->errorDescription    = $errorDescription;
    }

    public function getMessageId()
    {
        return $this->messageId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getNotificationMessage()
    {
        return $this->notificationMessage;
    }

    public function getDeliveryTimeStamp()
    {
        return $this->deliveryTimeStamp;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorDescription()
    {
        return $this->errorDescription;
    }
}
