<?php

class DataManager
{
    private static function getConnection()
    {
        $con = new mysqli('localhost', 'root', '', 'bookshop');
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
    public static function getCategories()
    {
        $categories = array();

        $con = self::getConnection();
        $res = self::query($con, "SELECT id, name FROM categories");
        while($cat = self::fetchObject($res))
        {
            $categories[] = new Category($cat->id, $cat->name);
        }

        self::close($res);
        self::closeConnection($con);

        return $categories;
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
        $res = self::query($con, "SELECT id, userName, passwordHash FROM users WHERE userName='$userName';");
        if($u = self::fetchObject($res))
        {
            $user = new User($u->id, $u->userName, $u->passwordHash);
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
        $res = self::query($con, "SELECT id, userName, passwordHash FROM users WHERE id='$userId';");
        if($u = self::fetchObject($res))
        {
            $user = new User($u->id, $u->userName, $u->passwordHash);
        }

        self::close($res);
        self::closeConnection($con);
        return $user;
    }
}