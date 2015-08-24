<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;
use Comsolit\ImasysPhp\AbstractResponse;

class DeliveryDisabledResponse extends AbstractResponse
{
    /*
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\ResponseInterface::parseResponse()
     */
    public static function parseResponse(CurlResponse $response)
    {
        return new DeliveryDisabledResponse();
    }
}
