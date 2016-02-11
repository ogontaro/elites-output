<?php

/**
 * Class Post
 */
class Post
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $user_id;
    /**
     * @var String
     */
    private $message;
    /**
     * @var Datetime
     */
    private $created_at;
    /**
     * @var Datetime
     */
    private $updated_at;

    /**
     * Post constructor.
     * @param Integer $id
     * @param Integer $user_id
     * @param String $message
     * @param Datetime $created_at
     * @param Datetime $updated_at
     */
    public function __construct($id, $user_id, $message, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->message = $message;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return String
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param String $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return Datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param Datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return Datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param Datetime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

}