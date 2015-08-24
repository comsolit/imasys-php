<?php

namespace Comsolit\ImasysPhp;

interface DebuggableInterface
{
    /**
     * Returns an associative array representation of the response
     */
    public function getDebugData();

    /**
     * @return String type of the request or response
     */
    public function getType();
}