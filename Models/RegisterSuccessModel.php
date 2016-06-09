<?php

class RegisterSuccessModel extends Model
{

    public function __construct($userName)
    {
        parent::__construct();
        $this->userName = $userName;
    }
    
}