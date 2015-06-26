<?php

namespace Comsolit\ImasysPhp\ApiMethods;

use Comsolit\ImasysPhp\RequestInterface;
use Comsolit\ImasysPhp\Credentials;
use Comsolit\ImasysPhp\ApiMethods\BatchStatusResponse as Response;
use Comsolit\ImasysPhp\Curl\Response as CurlResponse;

class BatchStatusRequest implements RequestInterface
{
    const TIMEOUT = 30000;

    private $batchId;

    function __construct($batchId)
    {
        $this->batchId = $batchId;
    }

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

    public function buildBody()
    {
    }

    public function parseResponse(CurlResponse $curlResponse)
    {
        return BatchStatusResponse::parseResponse($curlResponse);
    }
}