<?php

class BlogModel extends BaseModel
{
    public function __construct($blogPost, $likes=null, $isLiked=null,$errors=null)
    {
        parent::__construct($errors);
        $this->blogPost = $blogPost;
        $this->likes = $likes;
        $this->isLiked = $isLiked;
        //$this->context = $context;
    }
}