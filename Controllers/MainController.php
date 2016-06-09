<?php

class MainController extends Controller
{
    public function GET_index()
    {
        return $this->renderView('Home', new BaseModel());
    }
    public function GET_MyBlog()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');


        $blogPosts = DataManager::getBlogPostsForUser(AuthenticationManager::getAuthenticatedUser()->getId());

        return $this->renderView('MyBlogList', new BlogListModel($blogPosts,
            Controller::buildActionLink('MyBlogList',
                'Main',
                array('userId' => $this->getParameter('userId')))));
    }

    public function GET_Blog()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');


        $blogPosts = DataManager::getBlogPostsForUser($this->getParameter('userId'));

        return $this->renderView('BlogList', new BlogListModel($blogPosts,
            Controller::buildActionLink('BlogList',
                'Main',
                array('userId' => $this->getParameter('userId')))));
    }
    public function GET_UserList()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');
        
        $users = DataManager::getAllUsers();
        
        return $this->renderView('UserList', new UserModel($users,
            Controller::buildActionLink('UserList',
                'Main')));
    }
    public function GET_Search()
    {
        $books = $this->hasParameter('title') ? DataManager::getBooksForSearchCriteria($this->getParameter('title')) : null;
        
        return $this->renderView('Search',
            new SearchModel($this->getParameter('title'),
                $books,
                ShoppingCart::getAll(),
                Controller::buildActionLink('Search', 'Main', array('title'))));
    }
}