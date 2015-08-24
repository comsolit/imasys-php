<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Request;

/**
 * Manages the Portal Servers (Message Gateways) required for making API requests.
 */
class PortalServers
{
    /**
     * Contains the fetched portal urls
     *
     * @var array
     */
    private $urls;

    private $host;

    private $credentials;

    public function __construct($host, Credentials $credentials)
    {
        $this->host = $host;
        $this->credentials = $credentials;
    }

    /**
     * Fetches the portal urls.
     *
     * @param string $host
     * @param Credentials $credentials
     * @return PortalServers
     */
    private function fetchPortalServers()
    {
        $urls = [];

        $url = $this->host . '/IZ/GetPortalList.aspx?';

        $data = [
            'UserID' => $this->credentials->getUserName(),
            'Pwd' => $this->credentials->getPassword()
        ];

        $url = $url . http_build_query($data);

        $request = new Request($url);
        $request->run();

        if(!$request->wasSuccessful()){
            throw new \Exception($request->response->getState()['httpCode'] . ' on fetching Portal Servers with url: ' . $url);
        }

        $xml = simplexml_load_string($request->response->getState()['body']);

        foreach ($xml->ISPortals->children() as $portal)
        {
            array_push($urls, (string)$portal->Url);
        }

        return $urls;
    }

    /**
     * Returns the first portal's url
     */
    public function getPortalServer()
    {
        if (is_null($this->urls)) {
            $this->urls = $this->fetchPortalServers();
        }

        // TODO use random?
        return $this->urls[0];
    }
}