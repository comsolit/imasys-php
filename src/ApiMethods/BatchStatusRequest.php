<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\RequestInterface;
use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

/**
 * Builds a request for fetching a batch status.
 */
class BatchStatusRequest implements RequestInterface
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
     * @see \Comsolit\ImasysPhp\RequestInterface::buildBody()
     */
    public function buildBody()
    {
    }

    /**
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\RequestInterface::parseResponse()
     */
    public function parseResponse(CurlResponse $curlResponse)
    {
        return BatchStatusResponse::parseResponse($curlResponse);
    }

    /*
     * (non-PHPdoc)
     * @see \Comsolit\ImasysPhp\RequestInterface::getDebugData()
     */
    public function getDebugData()
    {
        return get_object_vars($this);
    }
}