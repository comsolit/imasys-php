<?php

namespace Comsolit\ImasysPhp\Curl;

class Response implements \Serializable
{
    protected $properties = [
        '_id'            => NULL,
        'body'           => '',
        'header'         => '',
        'url'            => '',
        'effectiveUrl'   => '',
        'contentType'    => '',
        'httpCode'       => '',
        'filetime'       => '',
        'totalTime'      => '',
        'namelookupTime' => '',
        'speedDownload'  => '',
        'contentLanguage' => '',
        'received'        => ''
    ];

    public function serialize()
    {
        return serialize( $this->properties );
    }

    public function unserialize( $serialized )
    {
        $this->properties = unserialize( $serialized );
    }

    public function __get( $name )
    {
        if( array_key_exists( $name, $this->properties ) )
        {
            return $this->properties[$name];
        }
    }

    /**
     *
     * @TODO throw exception on unknown property
     */
    public function __set( $name, $value )
    {
        if( array_key_exists( $name, $this->properties ) )
        {
            $this->properties[$name] = $value;
        }
    }

    public function parseCurlInfo( $curlInfo )
    {
        $map = array(
            'url'             => 'effectiveUrl',         // Last effective URL
            'content_type'    => 'contentType', // Content-type of downloaded object, NULL indicates
                                                // server did not send valid Content-Type: header
            'http_code'       => 'httpCode', // Last received HTTP code
            'filetime'        => 'filetime', // Remote time of the retrieved document, if -1 is
                                             // returned the time of the document is unknown
            'total_time'      => 'totalTime', // Total transaction time in seconds for last transfer
            'namelookup_time' => 'namelookupTime', // Time in seconds until name resolving was complete
            'speed_download'  => 'speedDownload' //  Average download speed
        );

        $properties =& $this->properties;
        foreach( $map as $curlKey => $ourKey )
        {
            if( array_key_exists( $curlKey, $curlInfo ) )
            {
                $properties[$ourKey] = $curlInfo[$curlKey];
            }
        }
    }

    public function __toString()
    {
        return $this->properties['body'];
    }

    public function getState()
    {
        return $this->properties;
    }

    /**
     * Extract parts of the header
     *
     * @param string  $name  Header to get
     * @return mixed  string if something were found | false if nothing match
     */
    public function getHeader( $name )
    {
        $pattern = '/'. $name .':(.*)/im';
        $result = [];
        if( preg_match( $pattern, $this->header, $result ) )
        {
            return trim($result[1]);
        }
        else
        {
            return false;
        }
    }
}
