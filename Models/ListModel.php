<?php

class ListModel extends BaseModel
{
    public function __construct($categories, $books, $cart, $context)
{
    parent::__construct();
    $this->categories = $categories;
    $this->books = $books;
    $this->cart = $cart;
    $this->context = $context;
}
}