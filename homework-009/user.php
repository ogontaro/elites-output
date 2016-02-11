<?php

/**
 * Class User
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $image_file;
    /**
     * @var string
     */
    private $image_type;
    /**
     * @var DateTime
     */
    private $created_at;
    /**
     * @var int
     */
    private $login_count;

    /**
     * User constructor.
     * @param integer $id
     * @param string $name
     * @param string $email
     * @param string $image_file
     * @param string $image_type
     * @param DateTime $created_at
     * @param integer $login_count
     */
    public function __construct($id, $name, $email, $image_file, $image_type, $created_at, $login_count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->image_file = $image_file;
        $this->image_type = $image_type;
        $this->created_at = $created_at;
        $this->login_count = $login_count;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getImageFile()
    {
        return $this->image_file;
    }

    /**
     * @param string $image_file
     */
    public function setImageFile($image_file)
    {
        $this->image_file = $image_file;
    }

    /**
     * @return string
     */
    public function getImageType()
    {
        return $this->image_type;
    }

    /**
     * @param string $image_type
     */
    public function setImageType($image_type)
    {
        $this->image_type = $image_type;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getLoginCount()
    {
        return $this->login_count;
    }

    /**
     * @param int $login_count
     */
    public function setLoginCount($login_count)
    {
        $this->login_count = $login_count;
    }
    /**
     * ログイン回数を増やす
     * @return int
     */
    public function incrementLoginCount()
    {
        $this->setLoginCount($this->getLoginCount()+1);
    }


}