<?php
$errors = array();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $m_str = $_POST['m'];
    $n_str = $_POST['n'];

    if (empty($m_str)) {
        if ($m_str == '0') {
            $errors['m'] = 'mが正の数字ではありません';
        } else {
            $errors['m'] = 'mの数字を入力してください';
        }
    } elseif (!ctype_digit($m_str)) {
        $errors['m'] = 'mが正の数字ではありません';
    } else {
        try {
            $m = intval($m_str);
        } catch (Exception $error) {
            $errors['m'] = 'mが正の数字ではありません';
        }
    }

    if (empty($n_str)) {
        if ($m_str == '0') {
            $errors['n'] = 'nは2桁以上です';
        } else {
            $errors['n'] = 'nの数字を入力してください';
        }
    } elseif (!ctype_digit($n_str)) {
        $errors['n'] = 'nが正の数字ではありません';
    } else {
        try {
            $n = intval($n_str);
            if ($n < 2) {
                $errors['n'] = 'nは2桁以上です';
            }
        } catch (Exception $error) {
            $errors['n'] = 'nが正の数字ではありません';
        }
    }


    if (empty($errors)) {
        $formated_num = str_pad($m, $n, 0, STR_PAD_LEFT);
    }
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
    <h1>課題「数字の出力フォーマット」</h1>
    <p>ある正の整数m と 桁数n(nは2以上) を入力すると、m を 0埋めn桁で出力する。</p>
    <p>[実行結果例1] m = 71, n = 4 のとき 0071</p>
    <p>[実行結果例2] m = 719, n = 2 のとき 719</p>
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
        <div class="form-group <?php if (!empty($errors['m'])) echo 'has-error'; ?>">
            <label class="control-label">m</label>
            <input type="text" class="form-control" name="m"
                   placeholder="例: 71" <?php if (!empty($m_str)) echo 'value="' . $m_str . '"'; ?>>
        </div>
        <div class="form-group <?php if (!empty($errors['n'])) echo 'has-error'; ?>">
            <label class="control-label">n</label>
            <input type="text" class="form-control" name="n"
                   placeholder="例: 4" <?php if (!empty($n_str)) echo 'value="' . $n_str . '"'; ?>>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="送信">
        </div>
    </form>
    <?php
    if (!empty($formated_num)) {
        ?>
        <p>整数m: <?php echo $m; ?></p>
        <p>桁数n: <?php echo $n; ?></p>
        <p>フォーマット結果: <?php echo $formated_num; ?></p>
        <?php
    }
    ?>

</div>
</body>
</html>