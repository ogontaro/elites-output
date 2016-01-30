<?php
require_once('functions.php');
require_once("post_mapper.php");
require_once("post.php");

$post_mapper = new PostMapper(connectDb());
$posts = $post_mapper->all();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿内容</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container">
    <h1>投稿された内容</h1>
    <?php if (count($posts)) : ?>
        <ul>
            <?php foreach ($posts as $post) : ?>
                <li>
                    <div class="post-header">
                        <?php echo h($post->getName()) ?>
                    </div>
                    <div class="post-contents">
                        <p>「<?php echo h($post->getImpression()) ?>」</p>                        <?php
                        if (!is_null($post->getImageFile())) {
                            ?>
                            <p><img src="image.php?id=<?php echo $post->getId() ?>" class="image-file img-rounded" alt="投稿画像"></p>                            <?php
                        }
                        ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        現在、投稿された感想はありません。
    <?php endif; ?>
    <p><a href="index.php">戻る</a></p>
</div>
</body>
</html>