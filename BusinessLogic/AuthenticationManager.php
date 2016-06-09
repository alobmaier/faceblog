<?php

SessionContext::create();

class AuthenticationManager
{
    public static function authenticate($userName, $password)
    {
        $user = DataManager::getUserForUserName($userName);
        echo $user->getUserName();
        if($user != null && $user->getPasswordHash() == hash('sha1', "$userName|$password"))
        {
            $_SESSION['user'] = $user->getId();
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function signOut()
    {
        unset($_SESSION['user']);
    }
    public static function isAuthenticated()
    {
        return isset($_SESSION['user']);
    }
    public static function getAuthenticatedUser()
    {
        return self::isAuthenticated() ? DataManager::getUserForId($_SESSION['user']) : null;
    }
}