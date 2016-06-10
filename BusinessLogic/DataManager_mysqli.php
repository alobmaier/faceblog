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
    public static function getBlogPostsForUser($userId)
    {
        $blogPosts = array();
        $userId = intval($userId);

        $con = self::getConnection();
        $stmt = $con->prepare("SELECT id, userid, title, content, createdAt, updatedAt FROM blog_post WHERE userid=? ORDER BY createdAt DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();

        while($entry = self::fetchObject($res))
        {
            $blogPosts[] = new BlogPost($entry->id, $entry->userid, $entry->title, $entry->content, $entry->createdAt, $entry->updatedAt);
        }

        self::close($res);
        self::closeConnection($con);

        return $blogPosts;
    }
    public static function getBlogPostById($postId)
    {
        $post = null;

        $con = self::getConnection();
        $postId = intval($postId);
        $res = self::query($con, "SELECT id, userId, title, content FROM blog_post WHERE id='$postId';");
        if($p = self::fetchObject($res))
        {
            $post = new BlogPost($p->id, $p->userId, $p->title, $p->content, null, null);
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

        self::close($stmt);
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

        self::close($stmt);
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
        $users = null;

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
}