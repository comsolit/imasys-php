<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\ResponseInterface;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

class SendMessageResponse implements ResponseInterface
{
    private $batchId;

    public function getBatchId()
    {
        return $this->batchId;
    }

    public static function parseResponse(CurlResponse $response)
    {
        $body = $response->getState()['body'];

        $sendMessageResponse = new SendMessageResponse();

        if (!self::transmissionSuccessful($body)) {
            throw new \Exception($body);
        }

        $sendMessageResponse->batchId = self::getBatchIdFromBody($body);

        return $sendMessageResponse;
    }

    private static function transmissionSuccessful($bodyText)
    {
        if (self::stringStartsWith($bodyText, 'OK BatchGuid=')) {
            return true;
        }

        return false;
    }

    private static function getBatchIdFromBody($bodyText)
    {
        return end(explode('=', $bodyText));
    }

    private static function stringStartsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}
