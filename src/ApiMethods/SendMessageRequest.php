<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\RequestInterface;
use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\ApiMethods\SendMessageResponse as Response;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

class SendMessageRequest implements RequestInterface
{
    private $message;

    private $address;

    private $originator;

    function __construct($message, $address, $originator)
    {
        $this->message = $message;
        $this->address = $address;
        $this->originator = $originator;
    }

    public function buildUrl(Credentials $credentials, $host, $port)
    {
        $url = $host . '/IZ/sendmessage.aspx?';

        $data = [
            'UserID'     => $credentials->getUserName(),
            'Pwd'        => $credentials->getPassword(),
            'Address'    => $this->address,
            'Message'    => $this->message,
            'Originator' => $this->originator
        ];

        $url = $url . http_build_query($data, '', '&', PHP_QUERY_RFC3986);

        return $url;
    }

    public function buildBody()
    {
    }

    public function parseResponse(CurlResponse $curlResponse)
    {
        return SendMessageResponse::parseResponse($curlResponse);
    }
}
