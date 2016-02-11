<?php
require_once('config.php');
require_once('functions.php');
require_once('homework009_signup_form_model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $errors = array();
    $form_model = new Homework009SignupFormModel();

    $form_model->validate();
    $errors = $form_model->getErrors();

    // バリデーション突破後
    if (empty($errors))
    {
        $form_model->createUser();
        // ログイン画面へ飛ばす
        header('Location: login.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新規登録画面</title>
</head>
<body>
<h1>新規登録</h1>
<form action="" method="post" enctype="multipart/form-data">
    <p>
        ユーザーネーム: <input type="text" name="name">
        <?php if ($errors['name']) : ?>
            <?php echo h($errors['name']) ?>
        <?php endif ?>
    </p>
    <p>
        メールアドレス: <input type="text" name="email">
        <?php if ($errors['email']) : ?>
            <?php echo h($errors['email']) ?>
        <?php endif ?>
    </p>
    <p>
        プロフィール画像: <input type="file" name="image_file">
    </p>
    <input type="submit" value="登録する">
</form>
<a href="login.php">ログイン画面へ</a>
</body>
</html>