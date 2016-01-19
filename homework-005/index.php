<?php
require "form_model.php";

$errors = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $form_model = new FormModel($_POST);
    $form_model->validate();
    $errors = $form_model->getErrors();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>NOWALL | 課題「数字の出力フォーマット」</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>課題005「文字列からN番目」</h1>
    <p>長さm の半角アルファベット文字列s と 正の整数n が入力された時、</p>
    <p>文字列s の1番左の文字を1文字目として、n文字目のアルファベットを出力せよ。 </p>
    <p>ただし、n が m よりも大きい値をとる場合は、"m以下 正の整数を入力してください"と出力せよ。</p>
    <p>[実行結果例1] s = "hoge", n = 3 g</p>
    <p>[実行結果例2] s = "hoge", n = 5 4以下の正の整数を入力してください </p>
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
    <form action="" method="post">
        <div class="form-group <?php if (!empty($errors['s'])) echo 'has-error'; ?>">
            <label class="control-label">s</label>
            <input type="text" class="form-control" name="s"
                   placeholder="例: hogehoge" <?php if (isset($form_model) && !empty($form_model->getS())) echo 'value="' . $form_model->getS() . '"'; ?>>
        </div>
        <div class="form-group <?php if (!empty($errors['n'])) echo 'has-error'; ?>">
            <label class="control-label">n</label>
            <input type="text" class="form-control" name="n"
                   placeholder="例: 4" <?php if (isset($form_model) && !empty($form_model->getN())) echo 'value="' . $form_model->getN() . '"'; ?>>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="送信">
        </div>
    </form>
    <?php
    if (isset($form_model) && empty($form_model->getErrors())) {
        ?>
        <p>文字列s: <?php echo $form_model->getS(); ?></p>
        <p>数値n: <?php echo $form_model->getN(); ?></p>
        <p>n文字目: <?php echo $form_model->nextString(); ?></p>
        <?php
    }
    ?>

</div>
</body>
</html>