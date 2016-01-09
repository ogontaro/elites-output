<?php
// var_dump($_POST);

$name = $_POST['name'];
$impression = $_POST['impression'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>内容確認</title>
</head>
<body>
<h1>内容確認</h1>
<p>以下の内容でよろしいですか？</p>
名前: <?php echo htmlspecialchars($name,ENT_QUOTES,"UTF-8") ?><br>
感想: <?php echo htmlspecialchars($impression,ENT_QUOTES,"UTF-8") ?>
<form action="thankyou.php" method="post">
  <input type="hidden" name="name" value="<?php echo htmlspecialchars($name,ENT_QUOTES,"UTF-8") ?>">
  <input type="hidden" name="impression" value="<?php echo htmlspecialchars($impression,ENT_QUOTES,"UTF-8") ?>">
  <input type="submit" value="この内容で投稿">
</form>
<a href="index.php">戻る</a>
</body>
</html>