<?php

namespace Comsolit\ImasysPhp;

class Batch
{
    private $batchId;

    private $status;

    private $messages;

    function __construct($batchId, $status, $messages)
    {
        $this->batchId  = $batchId;
        $this->status   = $status;
        $this->messages = $messages;
    }

    public function getBatchId()
    {
        return $this->batchId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMessages()
    {
        return $this->messages;
    }
}