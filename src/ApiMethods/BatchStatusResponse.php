<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\ResponseInterface;
use Comsolit\ImasysPhp\Batch;
use Comsolit\ImasysPhp\Message;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

/**
 * Encapsulates IMASYS response information from a BatchStatusRequest.
 */
class BatchStatusResponse implements ResponseInterface
{
    /**
     * The Batch object.
     *
     * @var Batch
     */
    private $batch;

    /**
     * Returns the Batch object.
     *
     * @return \Comsolit\ImasysPhp\Batch
     */
    public function getBatch()
    {
        return $this->batch;
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
                    (string)$message->ErrorrDescription
                )
            );
        }

        $batchStatusResponse = new BatchStatusResponse();
        $batchStatusResponse->batch = new Batch($batchId, $status, $messages);

        return $batchStatusResponse;
    }
}
