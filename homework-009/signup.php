<?php
require_once('config.php');
require_once('functions.php');
require_once('homework009_signup_form_model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    $form_model = new Homework009SignupFormModel();

    $form_model->validate();
    $errors = $form_model->getErrors();

    // バリデーション突破後
    if (empty($errors)) {
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>新規登録</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group <?php if ($errors['name']) echo 'has-error'; ?>">
            <label class="control-label" for="name">ユーザーネーム</label>
            <input type="text" class="form-control" name="name">
            <?php if ($errors['name']) : ?>
                <p class="help-block"><?php echo h($errors['name']) ?></p>
            <?php endif ?>
        </div>
        <div class="form-group <?php if ($errors['email']) echo 'has-error'; ?>">
            <label for="email">Eメール</label>
            <input type="text" class="form-control" name="email">
            <?php if ($errors['email']) : ?>
                <p class="help-block"><?php echo h($errors['email']) ?></p>
            <?php endif ?>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">プロフィール画像</label>
            <input type="file" name="image_file">
        </div>
        <button type="submit" class="btn btn-default">登録する</button>
    </form>
    <a href="login.php">ログイン画面へ</a>
</div>
</body>
</html>