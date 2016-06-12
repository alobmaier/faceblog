<?php

class DataManager
{
    private static function getConnection()
    {
        $con = new mysqli('localhost', 'root', '', 'faceblogdb');
        if(mysqli_connect_errno())
        {
            throw new Exception('unable to connect to database');
        }
        return $con;
    }
    private static function query($connection, $query)
    {
        $res = $connection->query($query);
        if(!$res)
        {
            throw new Exception("error in query $query: " . $connection->error);
        }
        return $res;
    }
    private static function lastInsertId($connection)
    {
        return mysqli_insert_id($connection);
    }
    private static function fetchObject($cursor)
    {
        return $cursor->fetch_object();
    }
    private static function close($cursor)
    {
        $cursor->close();
    }
    private static function closeConnection($connection)
    {
        $connection->close();
    }

    public static function countUsers()
    {
        $counter = null;

        $con = self::getConnection();
        $res = self::query($con, "SELECT COUNT(*) as counter FROM blog_member");
        if($p = self::fetchObject($res))
        {
            $counter = intval($p->counter);
        }

        self::close($res);
        self::closeConnection($con);
        return $counter;
    }
    public static function countPosts()
    {
        $counter = null;

        $con = self::getConnection();
        $res = self::query($con, "SELECT COUNT(*) as counter FROM blog_post");
        if($p = self::fetchObject($res))
        {
            $counter = intval($p->counter);
        }

        self::close($res);
        self::closeConnection($con);
        return $counter;
    }
    public static function countPostsLastDay()
    {
        $counter = null;

        $con = self::getConnection();
        $res = self::query($con, "SELECT COUNT(*) as counter FROM blog_post WHERE createdAt >= now() - INTERVAL 1 DAY;");
        if($p = self::fetchObject($res))
        {
            $counter = intval($p->counter);
        }

        self::close($res);
        self::closeConnection($con);
        return $counter;
    }
    public static function getLastPost()
    {
        $lastpost = null;

        $con = self::getConnection();
        $res = self::query($con, "SELECT id, userid, title, content,createdAt, updatedAt FROM blog_post WHERE createdAt >=
                                            ALL(SELECT createdAt FROM blog_post) LIMIT 1;");
        if($entry = self::fetchObject($res))
        {
            $lastpost = new BlogPost($entry->id, $entry->userid, $entry->title, $entry->content, $entry->createdAt, $entry->updatedAt);
        }

        self::close($res);
        self::closeConnection($con);
        return $lastpost;
    }

    public static function getBlogPostsForUser($userId)
    {
        $blogPosts = array();
        $userId = intval($userId);

        $con = self::getConnection();
        $stmt = $con->prepare("SELECT id, userid, title, content, createdAt, updatedAt FROM blog_post WHERE userid=? ORDER BY createdAt DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($id,$userid,$title,$content,$createdAt,$updatedAt);

        while($stmt->fetch())
        {
            $likes = self::getLikesForPost($id);
            $blogPosts[] = new BlogPost($id, $userid, $title, $content, $createdAt, $updatedAt,
                $likes);
        }

        self::closeConnection($con);

        return $blogPosts;
    }
    public static function getBlogPostById($postId)
    {
        $post = null;

        $con = self::getConnection();
        $postId = intval($postId);
        $res = self::query($con, "SELECT id, userId, title, content,createdAt,updatedAt FROM blog_post WHERE id='$postId';");
        if($p = self::fetchObject($res))
        {
            $post = new BlogPost($p->id, $p->userId, $p->title, $p->content, $p->createdAt, $p->updatedAt);
        }

        self::close($res);
        self::closeConnection($con);
        return $post;
    }
    public static function createBlogPost($title, $content)
    {
        $con = self::getConnection();
        $userId = AuthenticationManager::getAuthenticatedUser()->getId();
        $title = $con->real_escape_string($title);
        $content = $con->real_escape_string($content);

        //insert new post
        $stmt = $con->prepare("INSERT INTO blog_post(userId, title, content, createdAt, updatedAt) VALUES(?,?,?,now(),now());");
        $stmt->bind_param("iss", $userId,$title, $content);
        $stmt->execute();

        self::query($con, "COMMIT;");

        $stmt->close();
        self::closeConnection($con);
    }
    public static function updateBlogPost($id, $title, $content)
    {
        $post = null;

        $con = self::getConnection();
        $postId = intval($id);
        $title = $con->real_escape_string($title);
        $content = $con->real_escape_string($content);
        $stmt = $con->prepare("UPDATE blog_post SET title = ?, content = ?, updatedAt = now() WHERE id = ?;");
        $stmt->bind_param("ssi", $title,$content,$postId);
        $stmt->execute();

        self::query($con, "COMMIT;");

        $stmt->close();
        self::closeConnection($con);
    }
    public static function deleteBlogEntryById($id)
    {
        $id = intval($id);
        $con = self::getConnection();
        self::query($con, "DELETE FROM blog_post WHERE id ='$id';");
    }

    public static function getUserForUserName($userName)
    {
        $user = null;

        $con = self::getConnection();
        $userName = $con->real_escape_string($userName);
        $res = self::query($con, "SELECT id, userName, displayName, passwordHash, startTime FROM blog_member WHERE userName='$userName';");
        if($u = self::fetchObject($res))
        {
            $user = new User($u->id, $u->userName, $u->displayName, $u->passwordHash, $u->startTime);
        }

        self::close($res);
        self::closeConnection($con);
        return $user;
    }
    public static function getUserForId($userId)
    {
        $user = null;

        $con = self::getConnection();
        $userId = intval($userId);
        $res = self::query($con, "SELECT id, userName, displayName, passwordHash, startTime FROM blog_member WHERE id='$userId';");
        if($u = self::fetchObject($res))
        {
            $user = new User($u->id, $u->userName, $u->displayName, $u->passwordHash, $u->startTime);
        }

        self::close($res);
        self::closeConnection($con);
        return $user;
    }
    public static function getAllUsers()
    {
        $users = array();

        $con = self::getConnection();

        $userid = AuthenticationManager::getAuthenticatedUser()->getId();
        $res = self::query($con, "SELECT * FROM blog_member WHERE id!='$userid';");
        while($u = self::fetchObject($res))
        {
            $users[] = new User($u->id, $u->userName, $u->displayName, $u->passwordHash, $u->startTime);
        }
        self::close($res);
        self::closeConnection($con);
        return $users;
    }
    public static function getUsersByDisplayName($displayName)
    {
        $users = array();


        $con = self::getConnection();
        $displayName = '%' . $con->real_escape_string($displayName) . '%';

        $userid = AuthenticationManager::getAuthenticatedUser()->getId();
        $stmt = $con->prepare("SELECT id, userName, displayName, passwordHash, startTime FROM blog_member WHERE id != ?
                                                            AND displayName LIKE ?;");
        $stmt->bind_param("is", $userid, $displayName);
        $stmt->execute();
        $stmt->bind_result($id, $userName, $displayName, $passwordHash, $startTime);
        while($stmt->fetch())
        {
            $users[] = new User($id, $userName, $displayName, $passwordHash, $startTime);
        }

        self::closeConnection($con);
        return $users;
    }
    public static function createUser($userName, $displayName, $password)
    {
        $con = self::getConnection();
        $userName = $con->real_escape_string($userName);
        $displayName = $con->real_escape_string($displayName);
        $password = $con->real_escape_string($password);

        $passwordHash = hash('sha1',"$userName|$password");

        //insert new user
        $stmt = $con->prepare("INSERT INTO blog_member(userName, displayName, passwordHash, startTime) VALUES(?,?,?,now());");
        $stmt->bind_param("sss", $userName,$displayName, $passwordHash);
        $stmt->execute();

        self::query($con, "COMMIT;");

        self::close($stmt);
        self::closeConnection($con);

    }

    /*---likes---*/
    public static function isPostLikedByAuthUser($postId)
    {
        $user = AuthenticationManager::getAuthenticatedUser()->getId();

        $con = self::getConnection();
        $stmt = $con->prepare("SELECT * FROM blog_like WHERE postId = ? and userId = ?");
        $stmt->bind_param("ii", $user,$postId);
        $stmt->execute();

        if($stmt->fetch() > 0)
        {
            //post was liked already
            $stmt->close();
            self::closeConnection($con);
            return true;
        }
        //post has not been liked until now from authenticated user
        $stmt->close();
        self::closeConnection($con);
        return false;
    }
    public static function addLike($postId)
    {
        $user = AuthenticationManager::getAuthenticatedUser()->getId();
        $postId = intval($postId);

        $con = self::getConnection();
        $stmt = $con->prepare("INSERT INTO blog_like(postId,userId) VALUES (?,?)");
        $stmt->bind_param("ii", $postId,$user);
        $stmt->execute();

        $stmt->close();
        self::closeConnection($con);
    }
    public static function removeLike($postId)
    {
        $user = AuthenticationManager::getAuthenticatedUser()->getId();
        $postId = intval($postId);

        $con = self::getConnection();
        $stmt = $con->prepare("DELETE FROM blog_like WHERE postId = ? AND userId = ?");
        $stmt->bind_param("ii", $postId,$user);
        $stmt->execute();

        $stmt->close();
        self::closeConnection($con);
    }
    public static function getLikesForPost($postId)
    {
        $likesFrom = array();
        $postId = intval($postId);
        $con = self::getConnection();
        $stmt = $con->prepare("SELECT userId FROM blog_like WHERE postId = ?");
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $stmt->bind_result($userid);

        while($stmt->fetch())
        {
            $likesFrom[] = $userid;
        }

        $stmt->close();
        self::closeConnection($con);

        return $likesFrom;
    }

}