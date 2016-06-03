<?php

class LoginModel extends BaseModel
{
    public function __construct($userName, $errors = null)
    {
        parent::__construct($errors);
        $this->userName = $userName;
    }
}

?>
