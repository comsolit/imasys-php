<?php

namespace Comsolit\ImasysPhp;

abstract class AbstractDebuggable implements DebuggableInterface
{
    public function getDebugData()
    {
        return get_object_vars($this);
    }

    public function getType()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}