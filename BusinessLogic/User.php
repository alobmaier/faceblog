<?php

class User extends Entity
{
    private $userName;
    private $passwordHash;
    private $displayName;
    private $startTime;

    public function getUserName()
    {
        return $this->userName;
    }
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
    public function __construct($id, $userName, $displayName, $passwordHash, $startTime)
    {
        parent::__construct($id);
        $this->userName = $userName;
        $this->displayName = $displayName;
        $this->passwordHash = $passwordHash;
        $this->startTime = $startTime;
    }
    
    public function getDisplayName()
    {
        return $this->displayName;
    }
    
    public function getStartTime()
    {
        return $this->startTime;
    }
}