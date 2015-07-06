<?php

namespace Comsolit\ImasysPhp;

/**
 * Encapsulates IMASYS batch properties.
 */
class Batch
{
    /**
     * The batch ID.
     *
     * @var string
     */
    private $batchId;

    /**
     * The batch status.
     *
     * @var string
     */
    private $status;

    /**
     * An array of messages contained in batch.
     *
     * @var array
     */
    private $messages;

    function __construct($batchId, $status, array $messages)
    {
        $this->batchId  = $batchId;
        $this->status   = $status;
        $this->messages = $messages;
    }

    /**
     * Returns the batch ID.
     *
     * @return string
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * Returns the batch status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns an array of messages contained in batch.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}