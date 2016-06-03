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
}