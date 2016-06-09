<?php

class UserModel extends BaseModel
{
    public function __construct($users, $context)
    {
        parent::__construct();
        $this->users = $users;
        $this->context = $context;
    }
}