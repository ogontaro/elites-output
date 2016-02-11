<?php
require_once 'config.php';
require_once 'user.php';
require_once 'functions.php';

/**
 * Class User
 */
class UserMapper
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

    //ToDo UserMapper->all 未実装
    /**
     *
     */
    public function all()
    {

    }

    //ToDo UserMapper->insert 未実装
    /**
     *
     */
    public function insert()
    {

    }

    /**
     * @param integer $id
     * @return User | false
     */
    public function findByID($id)
    {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'User',
            array('id', 'name', 'email', 'image_type', 'image', 'created_at', 'login_count'));
        return $stmt->fetch();
    }

    /**
     * @param string $email
     * @return User | false
     */
    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'User',
            array('id', 'name', 'email', 'image_type', 'image', 'created_at', 'login_count'));
        return $stmt->fetch();
    }

    /**
     * @param $login_form
     * @return false | User ログイン失敗時にfalseを返し、成功の場合はUserを返す。
     */
    public function login($login_form)
    {
        $dbh = connectDatabase();
        $sql = "select * from users where name = :name and email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":name", $login_form['name']);
        $stmt->bindParam(":email", $login_form['email']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,
            'User',
            array('id', 'name', 'email', 'image_type', 'image', 'created_at', 'login_count'));
        return $stmt->fetch();
    }

    /**
     * @param array $user
     * @return User | false
     */
    public function create($user)
    {
        $name = $user['name'];
        $email = $user['email'];
        $image_type = $user['image_type'];
        $image_file = $user['image_file'];

        $sql = 'INSERT INTO users (name, email , created_at ,image_type, image_file)  values (:name, :email, now(), :image_type, :image_file)';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('email', $email);
        if (is_null($image_type) || is_null($image_file)) {
            $stmt->bindValue(":image_type", null, PDO::PARAM_NULL);
            $stmt->bindValue(":image_file", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':image_type', $image_type);
            $stmt->bindParam(':image_file', $image_file);
        }
        $this->dbh->beginTransaction();
        $stmt->execute();
        $stmt->debugDumpParams();
        $user = $this->findByID($this->dbh->lastInsertId());
        $this->dbh->commit();
        return $user;
    }

    /**
     * @param User $user
     * @return User | false
     */
    public function update($user)
    {
        $id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $image_type = $user->getImageType();
        $image_file = $user->getImageFile();
        $login_count = $user->getLoginCount();

        $sql = 'UPDATE users SET name=:name, email=:email, image_type=:image_type, image_file=:image_file, login_count=:login_count WHERE id = :id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('name', $name);
        $stmt->bindParam('email', $email);
        if (is_null($image_type) || is_null($image_file)) {
            $stmt->bindValue(":image_type", null, PDO::PARAM_NULL);
            $stmt->bindValue(":image_file", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':image_type', $image_type);
            $stmt->bindParam(':image_file', $image_file);
        }
        $stmt->bindParam(':image_type', $image_type);
        $stmt->bindParam(':image_file', $image_file);
        $stmt->bindParam(':login_count', $login_count);
        $this->dbh->beginTransaction();
        $stmt->execute();
        $stmt->debugDumpParams();
        $user = $this->findByID($this->dbh->lastInsertId());
        $this->dbh->commit();
        return $user;
    }
}