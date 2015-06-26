<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\Curl\Request;

class PortalServers implements \Iterator
{
    private $urls;
    private $index = 0;

    public function current() {
        return $this->urls[$this->index];
    }

    public function next() {
        $this->index++;
    }

    public function key() {
        return $this->index;
    }

    public function valid() {
        return isset($this->urls[$this->key()]);
    }

    public function rewind() {
        $this->index = 0;
    }

    public static function fetchPortalServers($host, $credentials)
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

    public function getPortalServer()
    {
        return $this->urls[0];
    }
}