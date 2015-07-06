<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Request as CurlRequest;

/**
 * Send messages through an IMASYS gateway.
 */
class Connection
{
    /**
     * Credentials required for accessing the IMASYS Messaging Platform
     *
     * @var Credentials
     */
    private $credentials;

    /**
     * Contains a list of IMASYS portal urls
     *
     * @var PortalServers
     */
    private $portalServers;

    function __construct(Credentials $credentials, PortalServers $portalServers)
    {
        $this->credentials = $credentials;
        $this->portalServers = $portalServers;
    }

    /**
     * Send request to IMASYS Messaging Platform
     *
     * @param RequestInterface $request
     * @throws \Exception
     */
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
