<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;
use Comsolit\ImasysPhp\AbstractRequest;

/**
 * Builds a request for sending messages.
 */
final class SendMessageRequest extends AbstractRequest
{
    /**
     * The message to be sent.
     * @var string
     */
    protected $message;

    /**
     * The message recipient
     * @var string
     */
    protected $address;

    /**
     * The sender name.
     *
     * @var string
     */
    protected $originator;

    public function __construct($message, $address, $originator)
    {
        $this->message = $message;
        $this->address = $address;
        $this->originator = $originator;
    }

    /**
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\RequestInterface::buildUrl()
     */
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

        return $url . http_build_query($data, '', '&', PHP_QUERY_RFC3986);
    }

    public function parseResponse(CurlResponse $curlResponse)
    {
        return SendMessageResponse::parseResponse($curlResponse);
    }
}
