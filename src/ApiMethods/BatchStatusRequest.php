<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;
use Comsolit\ImasysPhp\AbstractRequest;

/**
 * Builds a request for fetching a batch status.
 */
class BatchStatusRequest extends AbstractRequest
{
    const TIMEOUT = 30000;

    /**
     * The batch ID.
     *
     * @var string
     */
    private $batchId;

    public function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

    /**
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\RequestInterface::buildUrl()
     */
    public function buildUrl(Credentials $credentials, $host, $port)
    {
        $url = $host . '/IZ/imasys.msggw?';

        $data = [
            'UserID'               => $credentials->getUserName(),
            'Pwd'                  => $credentials->getPassword(),
            'portal.function.name' => 'GetBatchStatus',
            'timeout'              => self::TIMEOUT,
            'BatchID'              => $this->batchId
        ];

        return $url . http_build_query($data);
    }

    /**
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\RequestInterface::parseResponse()
     */
    public function parseResponse(CurlResponse $curlResponse)
    {
        return BatchStatusResponse::parseResponse($curlResponse);
    }
}