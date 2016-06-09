<?php

/**
 * Created by PhpStorm.
 * User: Andi
 * Date: 09.06.2016
 * Time: 17:20
 */
class BlogPost extends Entity
{
    private $userId;
    private $title;
    private $content;
    private $createdAt;
    private $updatedAt;

    public function __construct($id, $userId, $title, $content, $createdAt, $updatedAt)
    {
        parent::__construct($id);
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

}