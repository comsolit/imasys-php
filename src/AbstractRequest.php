<?php

namespace Comsolit\ImasysPhp;

use Comsolit\ImasysPhp\RequestInterface;
use Comsolit\ImasysPhp\AbstractDebuggable;

abstract class AbstractRequest extends AbstractDebuggable implements RequestInterface
{
    public function buildBody()
    {
    }
}