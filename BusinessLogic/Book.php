<?php

class Book extends Entity
{
    private $categoryId;
    private $title;
    private $author;
    private $price;

    public function __construct($id, $categoryId, $title, $author, $price)
    {
        parent::__construct($id);
        $this->categoryId = $categoryId;
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTitle()
    {
        return $this->title;
    }
}