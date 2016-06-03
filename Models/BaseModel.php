<?php

class BaseModel extends Model
{
    public function __construct($errors = null)
    {
        parent::__construct();
        $this->user = AuthenticationManager::getAuthenticatedUser();
        $this->errors = $errors;
    }
}