<?php

class MainController extends Controller
{
    public function GET_Index()
    {
        //get stats
        $countusers = DataManager::countUsers();
        $countposts = DataManager::countPosts();
        $countpostslastday = DataManager::countPostsLastDay();
        $lastPost = DataManager::getLastPost();
        return $this->renderView('Home', new HomeModel($countusers,$countposts, $countpostslastday, $lastPost
            ),Controller::buildActionLink('Home',
            'Main'));
    }
    public function GET_MyBlog()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');


        $blogPosts = DataManager::getBlogPostsForUser(AuthenticationManager::getAuthenticatedUser()->getId());

        return $this->renderView('MyBlog', new BlogListModel($blogPosts,
            Controller::buildActionLink('MyBlog',
                'Main')));
    }

    public function GET_Blog()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');


        $blogPosts = DataManager::getBlogPostsForUser($this->getParameter('userId'));


        return $this->renderView('Blog', new BlogListModel($blogPosts,
            Controller::buildActionLink('Blog',
                'Main',
                array('userId' => $this->getParameter('userId')))));
    }
    public function POST_LikePost()
    {
        echo $this->getParameter('postId');
        $blogEntry = $this->hasParameter('postId') ? DataManager::getBlogPostById($this->getParameter('postId')) : null;
        DataManager::addLike($blogEntry->getId());

        return $this->redirectToUrl($this->getParameter('context'));
    }
    public function POST_UnlikePost()
    {
        echo $this->getParameter('postId');
        $blogEntry = $this->hasParameter('postId') ? DataManager::getBlogPostById($this->getParameter('postId')) : null;
        DataManager::removeLike($blogEntry->getId());

        return $this->redirectToUrl($this->getParameter('context'));
    }
    public function GET_AddPost()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');

        return $this->renderView('AddPost', new BaseModel(null));
    }
    public function POST_AddPost()
    {
        if(isset($_POST['title']) && isset($_POST['content']))
        {
            if(empty($_POST['title']) || empty($_POST['content']))
            {
                return $this->renderView('AddPost', new BaseModel(null, array('Fill out all input fields!')));
            }
            DataManager::createBlogPost($_POST['title'], $_POST['content']);

            $blogPosts = DataManager::getBlogPostsForUser(AuthenticationManager::getAuthenticatedUser()->getId());

            return $this->redirect('MyBlog', 'Main');
        }
    }
    public function GET_EditPost()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');

        //TODO check if blog was really posted by authenticated user!
        $id = $this->getParameter('postId');
        $post = DataManager::getBlogPostById($id);

        if($post !== null && $post->getUserId() == AuthenticationManager::getAuthenticatedUser()->getId())
        {
            return $this->renderView('EditPost', new BlogModel($post));
        }
        else
            $this->redirect('Home', 'Main');


    }
    public function POST_EditPost()
    {
        //TODO save post in db
        if(isset($_POST['title']) && isset($_POST['content']))
        {
            if(empty($_POST['title']) || empty($_POST['content']))
            {
                return $this->renderView('EditPost', new BaseModel(null, array('Fill out all input fields!')));
            }
            DataManager::updateBlogPost($_POST['postId'],$_POST['title'], $_POST['content']);
            $blogPosts = DataManager::getBlogPostsForUser(AuthenticationManager::getAuthenticatedUser()->getId());

            return $this->renderView('MyBlog', new BlogListModel($blogPosts,
                Controller::buildActionLink('MyBlog',
                    'Main')));
        }
    }
    public function GET_DeletePost()
    {
        $id = $this->getParameter('postId');

        DataManager::deleteBlogEntryById($id);

        $this->redirect('MyBlog', 'Main');
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
    public function POST_SearchUser()
    {
        if(!AuthenticationManager::isAuthenticated())
            $this->redirect('Login', 'User');

        $displayName = isset($_POST['displayName']) ? $_POST['displayName'] : '';

        $users = DataManager::getUsersByDisplayName($displayName);

        return $this->renderView('UserList', new UserModel($users,
            Controller::buildActionLink('UserList',
                'Main')));
    }
}