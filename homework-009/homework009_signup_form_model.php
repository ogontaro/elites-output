<?php
require_once 'user.php';
require_once 'functions.php';
require_once 'user_mapper.php';
/**
 * Class Homework009SignupFormModel
 */
class Homework009SignupFormModel
{
    /**
     * 投稿者名
     * @var string $name
     */
    private $name;

    /**
     * 感想
     * @var string $email
     */
    private $email;

    /**
     * 画像形式
     * @var null|string $image_type
     */
    private $image_type;

    /**
     * 文字列化した画像データ
     * @var null|string $image_file
     */
    private $image_file;

    /**
     * エラー情報
     * @var string[] $errors;
     */
    private $errors;

    /**
     * Homework009SignupFormModel constructor.
     */
    public function __construct()
    {
        $this->errors = array();
        if (isset($_POST["name"])) {
            $this->name = $_POST["name"];
        }

        if (isset($_POST["email"])) {
            $this->email = $_POST["email"];
        }

        if (isset($_FILES["image_file"]) && !empty($_FILES["image_file"]["tmp_name"])) {
            $this->image_type = $_FILES["image_file"]["type"];
            $this->image_file = file_get_contents($_FILES["image_file"]["tmp_name"]);
        }
    }

    /**
     * @return string{}
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * バリデーションを行う
     * エラーがある場合はerrorsにエラーが格納される。
     */
    public function validate()
    {
        $user_mapper = new UserMapper(connectDatabase());
        if (empty($this->name)) {
            $this->errors["name"] = "名前が未入力です";
        }
        if (empty($this->email)) {
            $this->errors["email"] = "メールが未入力です";
        }elseif($user_mapper->findByEmail($this->email) != false){
            $this->errors["email"] = "既に登録されているメールアドレスです";
        }
    }

    /**
     * @return User
     */
    public function createUser(){
        $user_mapper = new UserMapper(connectDatabase());

        $user = [
            "name" => $this->name,
            "email" => $this->email,
            "image_type" => $this->image_type,
            "image_file" => $this->image_file,
        ];
        return $user_mapper->create($user);
    }
}