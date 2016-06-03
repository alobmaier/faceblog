<?php

class User extends Entity
{
    private $userName;
    private $passwordHash;

    public function getUserName()
    {
        return $this->userName;
    }
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
    public function __construct($id, $userName, $passwordHash)
    {
        parent::__construct($id);
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
    }
}