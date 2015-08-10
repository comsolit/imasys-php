<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\ResponseInterface;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

class DeliveryDisabledResponse implements ResponseInterface
{
    /*
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\ResponseInterface::parseResponse()
     */
    public static function parseResponse(CurlResponse $response)
    {
        return new DeliveryDisabledResponse();
    }

    /*
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\ResponseInterface::getDebugData()
     */
    public function getDebugData()
    {
        return ['batchId' => 'unavailable'];
    }
}
