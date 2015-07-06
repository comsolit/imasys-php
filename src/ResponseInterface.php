<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

/**
 * Declares methods for handling IMASYS responses
 */
interface ResponseInterface
{
    /**
     * Parses the CurlResponse
     *
     * @param CurlResponse $response
     */
    public static function parseResponse(CurlResponse $response);
}
