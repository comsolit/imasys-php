<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\Message;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;
use Comsolit\ImasysPhp\AbstractResponse;

/**
 * Encapsulates IMASYS response information from a BatchStatusRequest.
 */
class BatchStatusResponse extends AbstractResponse
{
    /**
     * The batch ID.
     *
     * @var string
     */
    private $batchId;

    /**
     * The batch status.
     *
     * @var string
     */
    private $status;

    /**
     * An array of messages contained in batch.
     *
     * @var array
     */
    private $messages;

    public function __construct($batchId, $status, array $messages)
    {
        $this->batchId  = $batchId;
        $this->status   = $status;
        $this->messages = $messages;
    }

    /**
     * Returns the batch ID.
     *
     * @return string
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * Returns the batch status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns an array of messages contained in batch.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Parses the CurlResponse.
     *
     * @param CurlResponse $response
     * @return BatchStatusResponse
     */
    public static function parseResponse(CurlResponse $response)
    {
        $body = $response->getState()['body'];

        $xml = simplexml_load_string($body);

        $batchId  = (string)$xml->BatchID;
        $status   = (string)$xml->Status;
        $messages = [];

        foreach ($xml->Messages->children() as $message) {
            array_push($messages,
                new Message(
                    (string)$message->MsgID,
                    (string)$message->MsgStatus,
                    (string)$message->NotificationMsg,
                    (int)$message->DeliveryTimeStamp,
                    (int)$message->ErrorCode,
                    (string)$message->ErrorDescription
                )
            );
        }

        return new self($batchId, $status, $messages);
    }
}
