<?php

require_once('functions.php');

$dbh = connectDb();

$sql = "select * from posts";

$stmt = $dbh->prepare($sql);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($row);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿内容</title>
</head>
<body>
<h1>投稿された内容</h1>
<?php if (count($row)) : ?>
    <?php foreach ($row as $post) : ?>
        <li>
            「<?php echo h($post['impression']) ?>」
            @<?php echo h($post['name']) ?>
        </li>
    <?php endforeach; ?>
<?php else : ?>
    現在、投稿された感想はありません。
<?php endif; ?>
<p><a href="index.php">戻る</a></p>
</body>
</html>