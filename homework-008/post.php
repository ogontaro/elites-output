<?php

/**
 * 感想データのクラス
 * Class Post
 */
class Post
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * 感想
     * @var string
     */
    private $impression;

    /**
     * 投稿日
     * @var DateTime|null
     */
    private $created_at;

    /**
     * 画像形式
     * @var null|string
     */
    private $image_type;

    /**
     * 文字列化した画像データ
     * @var null|string
     */
    private $image_file;

    /**
     * Post constructor.
     * @param integer $id ID
     * @param string $name 投稿者名
     * @param string $impression 感想
     * @param DateTime $created_at 投稿日
     * @param string $image_type 画像形式
     * @param string $image_file 文字列化した画像データ
     */
    public function __construct($id = null, $name, $impression, $created_at = null, $image_type = null, $image_file = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->impression = $impression;
        $this->created_at = $created_at;
        $this->image_type = $image_type;
        $this->image_file = $image_file;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
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
     * @return Post
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getImpression()
    {
        return $this->impression;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    /**
     * @param DateTime|null $created_at
     * @return Post
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImageType()
    {
        return $this->image_type;
    }

    /**
     * @param null|string $image_type
     * @return Post
     */
    public function setImageType($image_type)
    {
        $this->image_type = $image_type;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getImageFile()
    {
        return $this->image_file;
    }

    /**
     * @param null|string $image_file
     * @return Post
     */
    public function setImageFile($image_file)
    {
        $this->image_file = $image_file;
        return $this;
    }
}