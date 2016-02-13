<?php
require_once 'user.php';
require_once 'user_mapper.php';
require_once('config.php');
require_once('functions.php');

session_start();

if (!empty($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $errors = array();

    // バリデーション
    if ($name == '') {
        $errors['name'] = 'ユーザーネームが未入力です';
    }

    if ($email == '') {
        $errors['email'] = 'メールアドレスが未入力です';
    }

    // バリデーション突破後
    if (empty($errors)) {
        $dbh = connectDatabase();
        $user_mapper = new UserMapper(connectDatabase);
        $login_form = [
            'name' => $name,
            'email' => $email
        ];
        $user = $user_mapper->login($login_form);
        if ($user) {
            $user->incrementLoginCount();
            $user_mapper->update($user);

            $_SESSION['user'] = serialize($user);
            header('Location: index.php');
            exit;
        } else {
            echo 'ユーザーネームかメールアドレスが間違っています';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>ログイン</h1>
    <form action="" method="post">
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
        <button type="submit" class="btn btn-default">ログイン</button>
    </form>
    <a href="signup.php">新規登録はこちら！</a>
</div>
</body>
</html>