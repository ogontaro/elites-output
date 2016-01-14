<?php

/**
 * 有効なメールアドレスか判定する
 * @param $email String 判定対象のメールアドレス
 * @return boolean 正しい場合はtrueを返す
 */
function isValidEmailAddress($email){
    $email_regex = <<<TAG
/^(?:(?:(?:(?:[a-zA-Z0-9_!#\$\%&'*+\/=?\^`{}~|\-]+)(?:\.(?:[a-zA-Z0-9_!#\$\%&'*+\/=?\^`{}~|\-]+))*)|(?:"(?:\\[^\r\n]|[^\\"])*")))\@(?:(?:(?:(?:[a-zA-Z0-9_!#\$\%&'*+\/=?\^`{}~|\-]+)(?:\.(?:[a-zA-Z0-9_!#\$\%&'*+\/=?\^`{}~|\-]+))*)|(?:\[(?:\\\S|[\x21-\x5a\x5e-\x7e])*\])))$/
TAG;
    return preg_match($email_regex, $email);
}

/**
 * メールを送信する
 * @param $name  String 送信者の名前
 * @param $from  String 送信元メールアドレス
 * @param $to    String 送信先メールアドレス
 * @param $title String 件名
 * @param $body  String 本文
 * @return       bool   メール送信に成功したらtrueを返す
 */
function sendMail($name, $from, $to, $title, $body){
    $formedFrom = mb_encode_mimeheader(mb_convert_encoding($name,"JIS","UTF-8"))."<".$from.">";
    return mb_send_mail($to,$title,$body,"From: ".$formedFrom);
}

$errors = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $title = $_POST['title'];
    $email = $_POST['email'];
    $body = $_POST['body'];

    if(empty($name)){
        $errors['name'] = '名前が入力されていません';
    }
    if(empty($title)){
        $errors['title'] = '件名が入力されていません';
    }
    if(empty($email)){
        $errors['email'] = 'メールアドレスが入力されていません';
    }elseif(!isValidEmailAddress($email)){
        $errors['email'] = 'メールアドレスの形式が間違っています。';
    }
    if(empty($body)){
        $errors['body'] = '本文が入力されていません';
    }

    if(empty($errors)){
        $to = "example@example.com";
        if(!sendMail($name,$email,$to,$title,$body)){
            $errors['sendmail'] = "何らかの原因でメールが遅れませんでした。";
        }else{
            header('Location: inquery-complate.html');
        }
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>NOWALL | お問い合わせフォーム</title>
  <link rel="stylesheet" href="css/normalize.css" >
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" >
</head>
<body>
<div class="container">
    <h1>お問い合わせフォーム</h1>
    <?php
        foreach($errors as $error){?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $error ?>
            </div>
            <?php
        }
    ?>
    <form action="" method="post">
        <div class="form-group <?php if(!empty($errors['name'])) echo 'has-error' ?>">
            <label class="control-label">お名前</label>
            <input type="text" class="form-control" name="name" placeholder="田中太郎" <?php if(!empty($name)) echo 'value="'. $name. '"'; ?>>
        </div>
        <div class="form-group <?php if(!empty($errors['title'])) echo 'has-error' ?>">
            <label class="control-label">件名</label>
            <input type="text" class="form-control" name="title" placeholder="商品発送日時の件" <?php if(!empty($title)) echo 'value="'. $title. '"'; ?>>
        </div>
        <div class="form-group <?php if(!empty($errors['email'])) echo 'has-error' ?>">
            <label class="control-label">メールアドレス</label>
            <input type="text" class="form-control" name="email" placeholder="example@example.com" <?php if(!empty($email)) echo 'value="'. $email. '"'; ?>>
        </div>
        <div class="form-group <?php if(!empty($errors['body'])) echo 'has-error' ?>">
            <label class="control-label">本文</label>
            <textarea class="form-control" name="body" placeholder="本文をここに"><?php if(!empty($body)) echo $body; ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="送信" />
        </div>
    </form>
</div>
</body>
</html>