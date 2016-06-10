<?php

class BlogModel extends BaseModel
{
    public function __construct($blogPost)
    {
        parent::__construct();
        $this->blogPost = $blogPost;
        //$this->context = $context;
    }
}