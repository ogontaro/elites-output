<?php
require_once "homework008_form_model.php";
require_once "post_mapper.php";
require_once "post.php";

$errors = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_model = new Homework008FormModel($_POST);
    $form_model->validate();
    if (empty($form_model->getErrors())) {
        $post = $form_model->createPost();
    }else{
        $errors = $form_model->getErrors();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>感想投稿フォーム</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container">
    <h1>感想投稿フォーム</h1>
    <p>名前と感想を入力してね！</p>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
        foreach ($errors as $error) {
            ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $error ?>
            </div>
            <?php
        }
        ?>
        <div class="form-group">
            <label for="name">名前</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="impression">感想</label>
            <input type="text" class="form-control" name="impression">
        </div>
        <div class="form-group">
            <label for="image_file">画像</label>
            <input type="file" name="image_file">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="感想を投稿">
        </div>


    </form>

    <?php
    if (isset($post)) {
        ?>
        <h2>下記の内容が投稿されました</h2>
        <dl>
            <dt>名前</dt>
            <dd><?php echo h($post->getName()) ?></dd>
            <dt>感想</dt>
            <dd><?php echo h($post->getImpression()) ?></dd>
        </dl>
        <?php
        if(!is_null($post->getImageFile())){
            ?>
            <img src="image.php?id=<?php echo $post->getId() ?>" class="image-file img-rounded" alt="投稿画像">
            <?php
        }
        ?>
        <?php
    }
    ?>
    <p><a href="results.php">投稿内容を見る</a></p>
</div>
</body>
</html>