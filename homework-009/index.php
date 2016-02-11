<?php

require_once('config.php');
require_once('functions.php');
require_once('user.php');
require_once('user_mapper.php');
require_once('post.php');
require_once('post_mapper.php');

session_start();

if (empty($_SESSION['user']))
{
    header('Location: login.php');
    exit;
}

/** @var User $user */
$user = unserialize($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $message = $_POST['message'];
    $errors = array();

    // バリデーション
    if ($message == '')
    {
        $errors['message'] = 'メッセージが未入力です';
    }

    // バリデーション突破後
    if (empty($errors))
    {
        $dbh = connectDatabase();
        $post_mapper = new PostMapper($dbh);
        $post=[
            "user_id" => $user->getId(),
            "message" => $message
        ];
        $posts = $post_mapper->create($post);

        header('Location: index.php');
        exit;

    }


}
$dbh = connectDatabase();

$post_mapper = new PostMapper($dbh);
$posts = $post_mapper->all();

$user_mapper = new UserMapper($dbh);

// var_dump($posts);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員制掲示版</title>
</head>
<body>
<h1><?php echo h($user->getName()) ?>さん 会員制掲示版へようこそ！</h1>
<p><a href="logout.php">ログアウト</a></p>
<p><?php echo $user->getLoginCount() ?>回目のログインです。</p>
<p>一言どうぞ！</p>
<form action="" method="post">
    <textarea name="message" cols="30" rows="5"></textarea>
    <?php if ($errors['message']) : ?>
        <?php echo h($errors['message']) ?>
    <?php endif ?>
    <input type="submit" value="投稿する">
</form>
<hr>
<h1>投稿されたメッセージ</h1>
<?php if (count($posts)) : ?>
    <?php foreach ($posts as $post) :
        $user = $user_mapper->findByID($post->getUserId());
        ?>
        <li style="list-style-type: none;">
            [#<?php echo h($post->getId()) ?>]
            @<?php echo h($user->getName()) ?><br>
            <img src="profileimage.php?id=<?php echo h($user->getId()) ?>"  alt="">

            <?php echo h($post->getMessage()) ?><br>
            <a href="edit.php?id=<?php echo h($post->getId()) ?>">[編集]</a>
            <a href="delete.php?id=<?php echo h($post->getId()) ?>">[削除]</a>
            <?php echo h($post->getUpdatedAt()) ?>
            <hr>
        </li>
    <?php endforeach ?>
<?php else : ?>
    投稿されたメッセージはありません
<?php endif ?>
</body>
</html>