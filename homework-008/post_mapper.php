<?php
require_once(dirname(__FILE__) . "/post.php");

/**
 * Class PostMapper
 */
class PostMapper
{
    /**
     * @var PDO
     */
    private $dbh;

    /**
     * PostMapper constructor.
     * @param $dbh PDO
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * @param $id
     * @return Post|false
     */
    function findByID($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Post',
            array('id', 'name', 'impression', 'created_at', 'image_type', 'image'));
        return $stmt->fetch();
    }

    /**
     * @return Post[]|false
     */
    function all()
    {
        $sql = 'SELECT * FROM posts';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'Post',
            array('id', 'name', 'impression', 'created_at', 'image_type', 'image'));
        return $stmt->fetchAll();
    }

    /**
     * @param $post Post
     * @return bool
     */
    function insert($post)
    {
        $sql = "INSERT INTO posts (name, impression , created_at ,image_type, image_file)  values (:name, :impression, now(), :image_type, :image_file)";
        $stmt = $this->dbh->prepare($sql);
        $name = $post->getName();
        $impression = $post->getImpression();
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':impression', $impression);
        if (is_null($post->getImageType())) {
            $stmt->bindValue(":image_type", null, PDO::PARAM_NULL);
            $stmt->bindValue(":image_file", null, PDO::PARAM_NULL);
        } else {
            $image_type = $post->getImageType();
            $image_file = $post->getImageFile();
            $stmt->bindParam(':image_type', $image_type);
            $stmt->bindParam(':image_file', $image_file);
        }
        return $stmt->execute();
    }

    function create($name, $impression, $image_type, $image_file)
    {
        $sql = "INSERT INTO posts (name, impression , created_at ,image_type, image_file)  values (:name, :impression, now(), :image_type, :image_file)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':impression', $impression);
        if (is_null($image_type) || is_null($image_file)) {
            $stmt->bindValue(":image_type", null, PDO::PARAM_NULL);
            $stmt->bindValue(":image_file", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':image_type', $image_type);
            $stmt->bindParam(':image_file', $image_file);
        }
        $this->dbh->beginTransaction();
        $stmt->execute();
        $post = $this->findByID($this->dbh->lastInsertId());
        $this->dbh->commit();
        return $post;
    }
}