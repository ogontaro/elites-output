<?php

require_once('config.php');
require_once('functions.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $row_password = $_POST['password'];
    $errors = array();

    // バリデーション
    if ($name == '') {
        $errors['name'] = 'ユーザネームが未入力です';
    }

    if ($row_password == '') {
        $errors['password'] = 'パスワードが未入力です';
    }

    if (is_registered($name)) {
        $errors['registered_name'] = '既に登録されているユーザーネームなので変更してください';
    }

    $password = my_password_hash($row_password);
    // バリデーション突破後
    if (empty($errors)) {
        $dbh = connectDatabase();

        $sql = "insert into users (name, hashed_password, created_at) values
                (:name, :password, now());";
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":password", $password);

        $stmt->execute();

        var_dump($_POST);
        echo '<hr>';
        var_dump($errors);

        header('Location: login.php');
        exit;

    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録画面</title>
</head>
<body>
<h1>新規登録画面です</h1>
<form action="" method="post">
    ユーザネーム: <input type="text" name="name">
    <?php if ($errors['name']) : ?>
        <?php echo h($errors['name']) ?>
    <?php endif; ?>
    <?php if ($errors['registered_name']) : ?>
        <?php echo h($errors['registered_name']) ?>
    <?php endif; ?>
    <br>
    パスワード: <input type="text" name="password">
    <?php if ($errors['password']) : ?>
        <?php echo h($errors['password']) ?>
    <?php endif; ?>
    <br>
    <input type="submit" value="新規登録">
</form>
<a href="login.php">ログインはこちら</a>
</body>
</html>