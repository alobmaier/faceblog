<?php

class DataManager
{
    private static function getConnection()
    {
        $con = new mysqli('localhost', 'root', '', 'blogdb');
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
        $stmt = $con->prepare("SELECT id, userid, title, content, createdAt, updatedAt FROM blog_posts WHERE userid=?");
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
    public static function getBooksForCategory($categoryId)
    {
        $books = array();

        $con = self::getConnection();
        $res = self::query($con, "SELECT id, categoryId, title, author, price FROM books WHERE categoryId = $categoryId");
        while($book = self::fetchObject($res))
        {
            $books[] = new Book($book->id, $book->categoryId, $book->title, $book->author, $book->price);
        }

        self::close($res);
        self::closeConnection($con);

        return $books;
    }
    public static function getBooksForSearchCriteria($title)
    {
        $books = array();

        $con = self::getConnection();
        $title = $con->real_escape_string($title);
        $res = self::query($con, "SELECT id, categoryId, title, author, price FROM books WHERE title LIKE '%$title%';");
        while($book = self::fetchObject($res))
        {
            $books[] = new Book($book->id, $book->categoryId, $book->title, $book->author, $book->price);
        }

        self::close($res);
        self::closeConnection($con);

        return $books;
    }
    public static function createOrder($userId, $bookIds, $nameOnCard, $cardNumber)
    {
        $con = self::getConnection();

        self::query($con, "BEGIN;");
        $userId = intval($userId);
        $nameOnCard = $con->real_escape_string($nameOnCard);
        $cardNumber = $con->real_escape_string($cardNumber);
        self::query($con, "INSERT INTO orders (userId, creditCardNumber, creditCardHolder) VALUES ($userId, $cardNumber, $nameOnCard);");
        $orderId = self::lastInsertId($con);
        foreach ($bookIds as $bookId)
        {
            $bookId = intval($bookId);
            self::query($con, "INSERT INTO orderedBooks (orderId, bookId) VALUES ($orderId, $bookId);");
        }
        self::query($con, "COMMIT;");

        self::closeConnection($con);

        return $orderId;
    }

    public static function getUserForUserName($userName)
    {
        $user = null;

        $con = self::getConnection();
        $userName = $con->real_escape_string($userName);
        $res = self::query($con, "SELECT id, userName, displayName, passwordHash, startTime FROM blog_members WHERE userName='$userName';");
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
        $res = self::query($con, "SELECT id, userName, displayName, passwordHash, startTime FROM blog_members WHERE id='$userId';");
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
        $res = self::query($con, "SELECT * FROM blog_members WHERE id!='$userid';");
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
        $stmt = $con->prepare("INSERT INTO blog_members(userName, displayName, passwordHash, startTime) VALUES(?,?,?,now());");
        $stmt->bind_param("sss", $userName,$displayName, $passwordHash);
        $stmt->execute();

        self::query($con, "COMMIT;");

        self::close($stmt);
        self::closeConnection($con);

    }
}