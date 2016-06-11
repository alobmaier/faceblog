<?php

/**
 * Created by PhpStorm.
 * User: Andreas
 * Date: 11.06.2016
 * Time: 16:56
 */
class Like
{
    private $postId;
    private $userId;

    public function __construct($postId, $userId)
    {
        $this->postId = $postId;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}