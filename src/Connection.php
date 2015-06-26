<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Request as CurlRequest;

class Connection
{
    private $host;

    private $credentials;

    private $portalServers;

    function __construct(Credentials $credentials, PortalServers $portalServers)
    {
        $this->credentials = $credentials;

        $this->portalServers = $portalServers;
    }

    public function send(RequestInterface $request)
    {
        $url = $request->buildUrl($this->credentials, $this->portalServers->getPortalServer(), 443);
        $body = $request->buildBody();
        $curlRequest = new CurlRequest($url);
        $curlRequest->setPostBody(urlencode($body));
        $curlRequest->run();

        if (!$curlRequest->wasSuccessful()) {
            throw new \Exception();
        }

        $curlResponse = $curlRequest->response;

        return $request->parseResponse($curlResponse);
    }
}
