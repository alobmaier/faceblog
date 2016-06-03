<?php

class SessionContext
{
    private static $isCreated = false;

    public static function create()
    {
        if(!self::$isCreated)
        {
            self::$isCreated = session_start();
        }
        return self::$isCreated;
    }
}