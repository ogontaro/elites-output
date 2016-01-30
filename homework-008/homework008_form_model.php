<?php
require_once 'post.php';
require_once 'functions.php';
/**
 * Class Homework008FormModel
 */
class Homework008FormModel
{
    /**
     * 投稿者名
     * @var string $name
     */
    private $name;

    /**
     * 感想
     * @var string $impression
     */
    private $impression;

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
     * Homework008FormModel constructor.
     */
    public function __construct()
    {
        $this->errors = array();
        if (isset($_POST["name"])) {
            $this->name = $_POST["name"];
        }

        if (isset($_POST["impression"])) {
            $this->impression = $_POST["impression"];
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
        if (empty($this->name)) {
            $this->errors["name"] = "名前が未入力です";
        }
        if (empty($this->impression)) {
            $this->errors["impression"] = "感想が未入力です";
        }
    }

    /**
     * @return Post
     */
    public function createPost(){
        $post_mapper = new PostMapper(connectDb());
        return $post_mapper->create($this->name,$this->impression,$this->image_type,$this->image_file);
    }
}