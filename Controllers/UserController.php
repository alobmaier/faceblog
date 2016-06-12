<?php

class UserController extends Controller
{
    public function GET_Login()
    {
        if(AuthenticationManager::isAuthenticated())
        {
            return $this->redirect('Index', 'Main');
        }
        return $this->renderView('Login', new LoginModel($this->getParameter('userName')));
    }
    public function POST_Login()
    {
        // try to authenticate the given user
        if(!AuthenticationManager::authenticate($this->getParameter('userName'), $this->getParameter('password')))
        {
            // show error
            return $this->renderView('Login', new LoginModel($this->getParameter('userName'), array('Invalid user name or password.')));
        }
        return $this->redirect("Index", "Main");
    }
    public function POST_Logout()
    {
        AuthenticationManager::signOut();
        return $this->redirect('index','Main');
    }
    public function GET_Register()
    {
        return $this->renderView('Register', new RegisterModel($this->getParameter('userName'), $this->getParameter('displayName')));
    }
    public function POST_Register()
    {
        //store in db
        $userName = $_POST['userName'];
        $displayName = $_POST['displayName'];
        $password = $_POST['password'];

        if(strlen($userName) < 3 || strlen($displayName) < 3)
            return $this->renderView('Register', new RegisterModel($userName,$displayName, array('User name and display name must have at least 3 characters!')));
        if(!ctype_alnum($userName) || !ctype_alnum($displayName))
            return $this->renderView('Register', new RegisterModel($userName,$displayName,array('User name or/and display name has unallowed characters like _,",+,-,...!"')));
        if(strlen($password) < 5)
            return $this->renderView('Register', new RegisterModel($userName,$displayName, array('Password must have at least 5 characters!')));
        if($_POST['password'] !== $_POST['confirmedPassword'])
        {
            //show error
            return $this->renderView('Register', new RegisterModel($userName,$displayName, array('Passwords do not match')));
        }
        if (DataManager::getUserForUserName($userName) == null)
        {
            DataManager::createUser($userName, $displayName, $password);
            return $this->renderView('RegisterSuccess', new RegisterSuccessModel($userName));
        }
        else
        {
            return $this->renderView('Register', new RegisterModel($userName, $displayName, array('User already exists!')));
        }
    }
}