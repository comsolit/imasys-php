<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

interface ResponseInterface
{
    public static function parseResponse(CurlResponse $response);
}
