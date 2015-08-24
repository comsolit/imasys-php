<?php

namespace Comsolit\ImasysPhp;

/**
 * Encapsulates the IMASYS account information.
 */
class Credentials
{
    /**
     * The user name.
     *
     * @var string
     */
    private $userName;

    /**
     * The password.
     *
     * @var string
     */
    private $password;

    public function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * Returns the user name.
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Returns the password.
     */
    public function getPassword()
    {
        return $this->password;
    }
}
