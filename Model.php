<?php

class Model
{
    private $_data;


    public function __construct()
    {
        $_data = array();
    }
    public function __get($property)
    {
        return array_key_exists($property, $this->_data) ? $this->_data[$property] : null;
    }

    public function __set($property, $value)
    {
        $this->_data[$property] = $value;
    }
}