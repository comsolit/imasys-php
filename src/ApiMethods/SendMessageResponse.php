<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;
use Comsolit\ImasysPhp\AbstractResponse;

/**
 * Encapsulates IMASYS response information from a SendMessageRequest.
 */
class SendMessageResponse extends AbstractResponse
{
    /**
     * The batch ID of the batch containing the sent message.
     * @var string
     */
    private $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    /**
     * Returns the batch ID of the batch containing the sent message.
     *
     * @return string
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * Parses the CurlResponse.
     *
     * @param CurlResponse $response
     * @throws \Exception
     * @return \Comsolit\ImasysPhp\ApiMethods\SendMessageResponse
     */
    public static function parseResponse(CurlResponse $response)
    {
        $body = $response->getState()['body'];

        if (!self::transmissionSuccessful($body)) {
            throw new \Exception($body);
        }

        return new self(self::getBatchIdFromBody($body));
    }

    /**
     * Checks if transmission was successful.
     *
     * @param string $bodyText
     * @return boolean
     */
    private static function transmissionSuccessful($bodyText)
    {
        return strpos($bodyText, 'OK BatchGuid=') === 0;
    }

    /**
     * Extracts the batch ID from the response body.
     *
     * @param string $bodyText
     */
    private static function getBatchIdFromBody($bodyText)
    {
        $bodyArray = explode('=', $bodyText);

        return end($bodyArray);
    }
}
