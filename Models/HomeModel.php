<?php

class HomeModel extends BaseModel
{
    public function __construct($countusers, $countposts, $countPostsLastDay, $lastPost)
    {
        parent::__construct();
        $this->countusers = $countusers;
        $this->countposts = $countposts;
        $this->countPostsLastDay = $countPostsLastDay;
        $this->lastPost = $lastPost;
    }
}