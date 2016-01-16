<?php
/**
 * DB接続用のPDOを返す
 * @return PDO
 */
function connectDatabase()
{
    try
    {
        return new PDO(DSN, USER, PASSWORD);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        exit;
    }
}

/**
 * XSS対策用に、無害な文字列に変換する
 * @param $s 対策前の文字列
 * @return string 対策後の文字列
 */
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

/**
 * 生のパスワードをハッシュ化したパスワードに変換する
 * @param $row_password ハッシュ化する前の文字列
 * @return string ハッシュ化した後の文字列
 */
function my_password_hash($row_password){
    return password_hash($row_password, PASSWORD_DEFAULT);
}

/**
 * すでに登録されているユーザネームか判定する
 * @param $name 判定対象のユーザネーム
 * @return bool 登録されているユーザネームの場合、trueを返す
 */
function is_registered($name){
    $dbh = connectDatabase();
    $sql = "SELECT name FROM users WHERE name = :name";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name', $name);

    $stmt->execute();

    if($stmt->fetch()){
        return true;
    }else{
        return false;
    }

}
