<?php

class BlogModel extends BaseModel
{
    public function __construct($blogPost, $likes=null, $isLiked=null)
    {
        parent::__construct();
        $this->blogPost = $blogPost;
        $this->likes = $likes;
        $this->isLiked = $isLiked;
        //$this->context = $context;
    }
}