<?php

class BlogListModel extends BaseModel
{
    public function __construct($blogPosts, $context)
    {
        parent::__construct();
        $this->blogPosts = $blogPosts;
        $this->context = $context;
    }
}