<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

interface RequestInterface
{
    public function buildUrl(Credentials $credentials, $host, $port);

    public function buildBody();

    public function parseResponse(CurlResponse $response);
}
