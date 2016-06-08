<?php

class RegisterModel extends Model
{
    public function __construct($userName, $displayName)
    {
        parent::__construct();
        $this->userName = $userName;
        $this->displayName = $displayName;
    }
}