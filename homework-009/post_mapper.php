<?php
require_once("post.php");

class PostMapper
{
    /**
     * @var PDO
     */
    private $dbh;

    /**
     * UserMapper constructor.
     */
    public function __construct()
    {
        $this->dbh = connectDatabase();
    }
    /**
     * @param $id
     * @return Post|false
     */
    public function findByID($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Post',
            array('id', 'user_id', 'message', 'created_at', 'updated_at'));
        return $stmt->fetch();
    }

    /**
     * @return Post[]|false
     */
    public function all()
    {
        $sql = 'SELECT * FROM posts  order by updated_at desc';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Post',
            array('id', 'name', 'impression', 'created_at', 'image_type', 'image'));
        return $stmt->fetchAll();
    }

    /**
     * @param $post
     * @return false|Post
     */
    public function create($post)
    {
        $sql = "INSERT INTO posts (user_id, message , created_at ,updated_at)  values (:user_id, :message, now(), now())";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':user_id', $post['user_id']);
        $stmt->bindParam(':message', $post['message']);
        $this->dbh->beginTransaction();
        $stmt->execute();
        $post = $this->findByID($this->dbh->lastInsertId());
        $this->dbh->commit();
        return $post;
    }
}