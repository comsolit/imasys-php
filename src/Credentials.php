<?php

namespace Comsolit\ImasysPhp;

class Credentials
{
    private $userName;

    private $password;

    function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
