<?php

class DataManager
{
    private static $_categories;
    private static $_books;
    private static $_users;

    public static function init()
    {
        self::$_categories = array(1 => new Category(1, "Mobile & Wireless Computing"),
            2 => new Category(2, "Functional Programming"),
            3 => new Category(3, "C / C++"),
            4 => new Category(4, "<< New Publications >>"));

        self::$_books = array(1 => new Book(1, 1, "Hello, Android:\nIntroducing Google's Mobile Development Platform", "Ed Burnette", 19.97),
            2 => new Book(2, 1, "Android Wireless Application Development", "Shane Conder, Lauren Darcey", 31.22),
            5 => new Book(5, 1, "Professional Flash Mobile Development", "Richard Wagner", 19.90),
            7 => new Book(7, 1, "Mobile Web Design For Dummies", "Janine Warner, David LaFontaine", 16.32),
            11 => new Book(11, 2, "Introduction to Functional Programming using Haskell", "Richard Bird", 74.75),
            //book with bad title to show scripting attack - add for scripting attack demo only
            //12 => new Book(12, 2, "Scripting (Attacks) for Beginners<script type=\"text/javascript\">alert('All your base are belong to us!');</script>", "John Doe", 9.99),
            14 => new Book(14, 2, "Expert F# (Expert's Voice in .NET)", "Antonio Cisternino, Adam Granicz, Don Syme", 47.64),
            16 => new Book(16, 3, "C Programming Language\n(2nd Edition)", "Brian W. Kernighan, Dennis M. Ritchie", 48.36),
            27 => new Book(27, 3, "C++ Primer Plus\n(5th Edition)", "Stephan Prata", 36.94),
            29 => new Book(29, 3, "The C++ Programming Language", "Bjarne Stroustrup", 67.49));

        self::$_users = array(1 => new User(1, "scm4", "a8af855d47d091f0376664fe588207f334cdad22")); //USER = scm4; PASSWORD = scm4
    }
    public static function getCategories()
    {
        return self::$_categories;
    }
    public static function getBooksForCategory($categoryId)
    {
        $res = array();

        foreach(self::$_books as $book)
        {
            if($book->getCategoryId() == $categoryId)
            {
                $res[] = $book;
            }
        }
        return $res;
    }
    public static function getBooksForSearchCriteria($title)
    {
        $res = array();

        foreach(self::$_books as $book)
        {
            $titleOk = ($title == '' || stripos($book->getTitle(), $title) !== false);
            if($titleOk)
            {
                $res[] = $book;
            }
        }
        return $res;
    }
    public static function createOrder($userId, $bookIds, $nameOnCard, $cardNumber)
    {
        return rand();
    }

    public static function getUserForUserName($userName)
    {
        foreach (self::$_users as $u)
        {
            if($u->getUserName() == $userName)
                return $u;
        }

        return null;
    }
    public static function getUserForId($userId)
    {
        return array_key_exists($userId, self::$_users) ? self::$_users[$userId] : null;
    }
    public static function authenticateUser($userName, $password)
    {
        foreach (self::$_users as $user)
        {
            // fake password check: user name must be equal to password
            if($user->getUserName() == $userName && $password == $userName)
            {
                return $user->getId();
            }
        }
        return false;
    }


}

DataManager::init();