<?php

class SearchModel extends BaseModel
{
    public function __construct($title, $books, $cart, $context)
    {
        parent::__construct();
        $this->title = $title;
        $this->books = $books;
        $this->cart = $cart;
        $this->context = $context;
    }
}