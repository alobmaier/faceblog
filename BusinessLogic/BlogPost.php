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
    private $likes = array();
    private $likesNames = array();

    public function __construct($id, $userId, $title, $content, $createdAt, $updatedAt, $likes=null)
    {
        parent::__construct($id);
        $this->userId = $userId;
        $this->title = $title;
        $this->content = $content;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->likes = $likes;
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

    /**
     * @return null
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param array|null $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }
    public function getLikeNames()
    {
        $this->likesNames = array();
        if(sizeof($this->likes) > 0)
        {
            foreach($this->likes as $userId)
            {
                $this->likesNames[] = DataManager::getUserForId($userId)->getDisplayName();
            }
        }
        return $this->likesNames;
    }

}