<?php

namespace Comsolit\ImasysPhp;

/**
 * Encapsulates IMASYS message properties.
 */
class Message
{
    /**
     * The message ID.
     *
     * @var string
     */
    private $messageId;

    /**
     * The message status.
     *
     * @var string
     */
    private $status;

    /**
     * The notification message from the GSM operators.
     *
     * @var string
     */
    private $notificationMessage;

    /**
     * Timestamp containing the message delivery time and date
     *
     * @var string
     */
    private $deliveryTimeStamp;

    /**
     * Unique error code
     *
     * @var string
     */
    private $errorCode;

    /**
     * Error description
     *
     * @var string
     */
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

    /**
     * Returns the message ID.
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Returns the message status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the notification message.
     *
     * @return string
     */
    public function getNotificationMessage()
    {
        return $this->notificationMessage;
    }

    /**
     * Returns the message delivery timestamp
     *
     * @return string
     */
    public function getDeliveryTimeStamp()
    {
        return $this->deliveryTimeStamp;
    }

    /**
     * Returns the unique error code.
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Returns the error description.
     *
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->errorDescription;
    }
}
