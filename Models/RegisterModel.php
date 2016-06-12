<?php

class RegisterModel extends BaseModel
{
    public function __construct($userName, $displayName, $errors=null)
    {
        parent::__construct($errors);
        $this->userName = $userName;
        $this->displayName = $displayName;
    }
}