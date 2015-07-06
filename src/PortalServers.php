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

    /**
     * Fetches the portal urls.
     *
     * @param string $host
     * @param Credentials $credentials
     * @return PortalServers
     */
    public static function fetchPortalServers($host, Credentials $credentials)
    {
        $urls = [];

        $url = $host . '/IZ/GetPortalList.aspx?';

        $data = [
            'UserID' => $credentials->getUserName(),
            'Pwd' => $credentials->getPassword()
        ];

        $url = $url . http_build_query($data);

        $request = new Request($url);
        $request->run();

        if ($request->wasSuccessful()) {
            $portalServers = new PortalServers();
            $xml = simplexml_load_string($request->response->getState()['body']);

            foreach ($xml->ISPortals->children() as $portal)
            {
                array_push($urls, (string)$portal->Url);
            }

            $portalServers->urls = $urls;
            return $portalServers;
        }
        else {
            return null;
        }
    }

    /**
     * Returns the first portal's url
     */
    public function getPortalServer()
    {
        return $this->urls[0];
    }
}