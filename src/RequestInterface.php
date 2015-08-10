<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

/**
 * Declares methods for building IMASYS requests and parsing the response
 */
interface RequestInterface
{
    /**
     * Builds the request url.
     *
     * @param Credentials $credentials
     * @param string $host
     * @param integer $port
     */
    public function buildUrl(Credentials $credentials, $host, $port);

    /**
     * Builds the request body.
     */
    public function buildBody();

    /**
     * Parses the CurlResponse.
     * @param CurlResponse $response
     */
    public function parseResponse(CurlResponse $response);

    /**
     * Returns an associative array representation of the request
     */
    public function getDebugData();
}
